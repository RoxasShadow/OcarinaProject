<?php
/**
	/login.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $user->purge($_POST['nickname']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', $user->getLanguage('title', 4).$user->getLanguage('title', 2).$user->config[0]->nomesito);
$rendering->addValue('description', $user->getLanguage('description', 2));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $user->getTotalVisits());

if($user->isLogged())
	$rendering->addValue('result', 'Hai già effettuato l\'accesso, non hai bisogno di farlo nuovamente.');
elseif($submit)
	if(($nickname !== '') && ($password !== '')) {
		if($user->login($nickname, $password)) {
			if($user->config[0]->log == 1)
				$user->log($nickname, 'Logged in.');
			$rendering->addValue('result', $user->getLanguage('login', 0).header('Refresh: 2; URL='.$user->config[0]->url_index.'/index.php?welcome=true'));
		}
		else {
			if($user->config[0]->log == 1)
				$user->log($nickname, 'Login failed.');
			$rendering->addValue('result', $user->getLanguage('login', 1));
		}
	}
	else {
		if($user->config[0]->log == 1)
			$user->log($nickname, 'Login failed.');
		$rendering->addValue('result', $user->getLanguage('login', 2));
	}
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('login.tpl');
