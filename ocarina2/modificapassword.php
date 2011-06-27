<?php
/**
	/modificapassword.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$oldPassword = ((isset($_POST['oldPassword'])) && ($_POST['oldPassword'] !== '')) ? $user->purge($_POST['oldPassword']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$confPassword = ((isset($_POST['confPassword'])) && ($_POST['confPassword'] !== '')) ? $user->purge($_POST['confPassword']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', 'Modifica password &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged) 
	if(($oldPassword !== '') && ($password !== '') && ($confPassword !== ''))
		if((md5($oldPassword) == $username[0]->password) && ($password == $confPassword) && (strlen($password) > 4))
			if($user->editUser('password', md5($password), $username[0]->nickname)) {
				if($config[0]->log == 1)
					$user->log($username[0]->nickname, 'Password modificated.');
				$rendering->addValue('result', 'La password è stata modificata con successo. Attendi per il redirect...'.header('Refresh: 2; URL=logout.php?redirect=login.php'));
			}
			else {
				if($config[0]->log == 1)
					$user->log($username[0]->nickname, 'Password modification failed');
				$rendering->addValue('result', 'È accaduto un errore durante la modifica della password.');
			}
		else {
			if($config[0]->log == 1)
				$user->log($username[0]->nickname, 'Password modification failed');
			$rendering->addValue('result', 'È accaduto un errore durante la modifica della password. Le cause possono essere diverse, tra cui l\'errato inserimento della vecchia password, la non coincidenza delle password immesse, oppure semplicemente la password da te immessa è minore di 4 caratteri.');
		}
	else
		$rendering->addValue('result', 'È accaduto un problema durante la modifica della password. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.');
else
	$rendering->addValue('result', 'Devi effettuare l\'accesso prima di poter modificare la password.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificapassword.tpl');
