<?php
/**
	/modificapassword.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$config = $ocarina->getConfig();
$oldPassword = ((isset($_POST['oldPassword'])) && (trim($_POST['oldPassword']) !== '')) ? $ocarina->purge($_POST['oldPassword']) : '';
$password = ((isset($_POST['password'])) && (trim($_POST['password']) !== '')) ? $ocarina->purge($_POST['password']) : '';
$confPassword = ((isset($_POST['confPassword'])) && (trim($_POST['confPassword']) !== '')) ? $ocarina->purge($_POST['confPassword']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 5).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 3));

if($ocarina->isLogged()) 
	if(($oldPassword !== '') && ($password !== '') && ($confPassword !== ''))
		if((md5($ocarina->salt.$oldPassword) == $ocarina->username[0]->password) && ($password == $confPassword) && (strlen($password) > 4))
			if($ocarina->editUser('password', md5($ocarina->salt.$password), $ocarina->username[0]->nickname)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Password modificated.');
				$ocarina->addValue('result', $ocarina->getLanguage('editpassword', 0).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/logout.php?redirect=login.php'));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Password modification failed');
				$ocarina->addValue('result', $ocarina->getLanguage('editpassword', 1));
			}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Password modification failed');
			$ocarina->addValue('result', $ocarina->getLanguage('editpassword', 2));
		}
	else
		$ocarina->addValue('result', $ocarina->getLanguage('editpassword', 3));
else
	$ocarina->addValue('result', $ocarina->getLanguage('editpassword', 4));
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('modificapassword.tpl');
