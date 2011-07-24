<?php
/**
	/admin/log.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 20).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado < 6))
	if(!$submit) {
		if($user->config[0]->log == 1)
			$user->log($user->username[0]->nickname, 'Logs readed.');
		$rendering->addValue('log', $user->getLog());
	}
	else
		if($user->username[0]->grado == 1)
			if($user->deleteLog()) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Logs deleted.');
				$rendering->addValue('result', $user->getLanguage('log', 0));
			}
			else {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Logs deletion failed.');
				$rendering->addValue('result', $user->getLanguage('log', 1));
			}
		else {
			if($user->config[0]->log == 1)
				$user->log($user->username[0]->nickname, 'Logs deletion failed.');
			$rendering->addValue('result', $user->getLanguage('log', 2));
		}
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('log.tpl');
