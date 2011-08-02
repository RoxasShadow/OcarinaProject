<?php
/**
	/login.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $ocarina->purge($_POST['nickname']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $ocarina->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 4).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 2));

if($ocarina->isLogged())
	$ocarina->addValue('result', 'Hai già effettuato l\'accesso, non hai bisogno di farlo nuovamente.');
elseif($submit)
	if(($nickname !== '') && ($password !== '')) {
		if($ocarina->login($nickname, $password)) {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($nickname, 'Logged in.');
			$ocarina->addValue('result', $ocarina->getLanguage('login', 0).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/index.php?welcome=true'));
		}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($nickname, 'Login failed.');
			$ocarina->addValue('result', $ocarina->getLanguage('login', 1));
		}
	}
	else {
		if($ocarina->config[0]->log == 1)
			$ocarina->log($nickname, 'Login failed.');
		$ocarina->addValue('result', $ocarina->getLanguage('login', 2));
	}
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('login.tpl');
