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

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Log &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);
$rendering->addValue('keywords', $user->config[0]->keywords);
$rendering->addValue('description', $user->config[0]->description);

if($logged)
	if(!$submit) {
		if($username[0]->grado < 6) {
			if($user->config[0]->log == 1)
				$user->log($username[0]->nickname, 'Logs readed.');
			$rendering->addValue('log', $user->getLog());
		}
		else {
			if($user->config[0]->log == 1)
				$user->log($username[0]->nickname, 'Access denied to logs.');
			$rendering->addValue('result', 'Accesso negato.');
		}			
	}
	else {
		if($username[0]->grado == 1) {
			if($user->deleteLog()) {
					if($user->config[0]->log == 1)
						$user->log($username[0]->nickname, 'Logs deleted.');
					$rendering->addValue('result', 'I log sono stati cancellati');
			}
			else {
				if($user->config[0]->log == 1)
					$user->log($username[0]->nickname, 'Logs deletion failed.');
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione dei log.');
			}
		}
		else {
			if($user->config[0]->log == 1)
				$user->log($username[0]->nickname, 'Logs deletion failed.');
			$rendering->addValue('result', 'Non sei abilitato a cancellare i log.');
		}
	}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('log.tpl');
