<?php
/**
	/login.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $user->purge($_POST['nickname']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('titolo', 'Login &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged)
	$rendering->addValue('result', 'Hai già effettuato l\'accesso, non hai bisogno di farlo nuovamente.');
elseif($submit)
	if(($nickname !== '') && ($password !== '')) {
		if($user->login($nickname, $password))
			$rendering->addValue('result', 'Login effettuato. Attendi per il redirect...'.header('Refresh: 2; URL=Aindex.php?welcome=true'));
		else
			$rendering->addValue('result', 'È accaduto un problema durante l\'accesso. Controlla di aver inserito i dati correttamente.');
	}
	else
		$rendering->addValue('result', 'È accaduto un problema durante l\'accesso. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
$rendering->renderize('login.tpl');
