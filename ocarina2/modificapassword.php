<?php
/**
	/modificapassword.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$oldPassword = ((isset($_POST['oldPassword'])) && ($_POST['oldPassword'] !== '')) ? $user->purge($_POST['oldPassword']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$confPassword = ((isset($_POST['confPassword'])) && ($_POST['confPassword'] !== '')) ? $user->purge($_POST['confPassword']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', $user->getLanguage('title', 5).$user->getLanguage('title', 2).$user->config[0]->nomesito);
$rendering->addValue('description', $user->getLanguage('description', 3));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $user->getTotalVisits());

if($user->isLogged()) 
	if(($oldPassword !== '') && ($password !== '') && ($confPassword !== ''))
		if((md5($oldPassword) == $user->username[0]->password) && ($password == $confPassword) && (strlen($password) > 4))
			if($user->editUser('password', md5($password), $user->username[0]->nickname)) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Password modificated.');
				$rendering->addValue('result', $user->getLanguage('editpassword', 0).header('Refresh: 2; URL='.$user->config[0]->url_index.'/logout.php?redirect=login.php'));
			}
			else {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Password modification failed');
				$rendering->addValue('result', $user->getLanguage('editpassword', 1));
			}
		else {
			if($user->config[0]->log == 1)
				$user->log($user->username[0]->nickname, 'Password modification failed');
			$rendering->addValue('result', $user->getLanguage('editpassword', 2));
		}
	else
		$rendering->addValue('result', $user->getLanguage('editpassword', 3));
else
	$rendering->addValue('result', $user->getLanguage('editpassword', 4));
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificapassword.tpl');
