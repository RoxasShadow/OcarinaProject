<?php
/**
	/modificaprofilo.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $user->purge($_POST['skin']) : '';
$bio = ((isset($_POST['bio'])) && ($_POST['bio'] !== '')) ? $user->purge($_POST['bio']) : '';
$avatar = ((isset($_POST['avatar'])) && ($_POST['avatar'] !== '')) ? $user->purge($_POST['avatar']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', 'Modifica profilo &raquo; '.$user->config[0]->nomesito);
$rendering->addValue('keywords', $user->config[0]->keywords);
$rendering->addValue('description', $user->config[0]->description);

if($user->isLogged())
	if(!$submit) {
		$rendering->addValue('email', $user->username[0]->email);
		$rendering->addValue('bio', $user->username[0]->bio);
		$rendering->addValue('avatar', $user->username[0]->avatar);
		$rendering->addValue('listaskin', $rendering->getSkinList());
		$rendering->addValue('skinattuale', $rendering->skin);
	}
	else {
		if(($user->isEmail($email)) && ($user->isImage($avatar)) && ($email !== '') && ($bio !== '') && ($skin !== '') && ($avatar !== '') && ($password !== ''))
			if(($user->isEmailUsed($user->username[0]->nickname, $email)) || (md5($password) !== $user->username[0]->password)) {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modification failed.');
				$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo. Controlla che l\'indirizzo email da te dato non sia già in uso e che la password sia corretta.');
			}
			elseif(($user->editUser('email', $email, $user->username[0]->nickname)) && ($user->editUser('bio', $bio, $user->username[0]->nickname)) && ($user->editUser('skin', $skin, $user->username[0]->nickname)) && ($user->editUser('avatar', $avatar, $user->username[0]->nickname))) {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modificated.');
				$rendering->addValue('result', 'Il profilo è stato modificato con successo. Attendi per il redirect...'.header('Refresh: 2; URL='.$user->config[0]->url_index.'/profilo.php?nickname='.$user->username[0]->nickname));
			}
			else {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modification failed.');
				$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo.');
			}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo. Controlla di aver inserito un indirizzo email e un avatar validi e di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Devi effettuare l\'accesso prima di poter modificare il tuo profilo.');
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificaprofilo.tpl');
