<?php
/**
	/registrazione.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $user->purge($_POST['nickname']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$confPassword = ((isset($_POST['confPassword'])) && ($_POST['confPassword'] !== '')) ? $user->purge($_POST['confPassword']) : '';
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', 'Registrazione &raquo; '.$user->config[0]->nomesito);
$rendering->addValue('keywords', $user->config[0]->keywords);
$rendering->addValue('description', $user->config[0]->description);

if($logged)
	$rendering->addValue('result', 'Sei già registrato, non hai bisogno di registrarti nuovamente.');
elseif($submit) {
	if($user->config[0]->registrazioni == 0)
		$rendering->addValue('result', 'Le registrazioni sono chiuse.');
	elseif(($nickname !== '') && ($password !== '') && ($confPassword !== '') && ($email !== '')) {
		if((($password == $confPassword) && (strlen($password) > 4)) || (strlen($nickname) > 4)) {
			unset($confPassword);
			$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), $user->config[0]->skin);
			if($user->createUser($array)) {
				$rendering->addValue('result', 'Registrazione completata. Attendi per il redirect...'.header('Refresh: 2; URL='.$user->config[0]->url_index.'/login.php'));
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registrated.');
			}
			else {
				$rendering->addValue('result', 'È accaduto un problema durante la registrazione. Controlla di non usare un nickname o un\'email già usata da un altro utente, e che quest\'ultima sia valida.');
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registration failed.');
			}
		}
		else
			$rendering->addValue('result', 'È accaduto un problema durante la registrazione: le due password non corrispondono oppure la password o il nickname da te immessi hanno meno di 4 caratteri. Attendi per il redirect...');
	}
	else
		$rendering->addValue('result', 'È accaduto un problema durante la registrazione. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.');
}
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('registrazione.tpl');
