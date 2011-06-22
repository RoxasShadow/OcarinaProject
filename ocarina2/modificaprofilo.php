<?php
/**
	/modificaprofilo.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $user->purge($_POST['skin']) : '';
$bio = ((isset($_POST['bio'])) && ($_POST['bio'] !== '')) ? $user->purge($_POST['bio']) : '';
$avatar = ((isset($_POST['avatar'])) && ($_POST['avatar'] !== '')) ? $user->purge($_POST['avatar']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', 'Modifica profilo &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged)
	if(!$submit) {
		$rendering->addValue('email', $username[0]->email);
		$rendering->addValue('bio', $username[0]->bio);
		$rendering->addValue('avatar', $username[0]->avatar);
		$rendering->addValue('listaskin', $rendering->getSkinList());
		$rendering->addValue('skinattuale', $rendering->skin);
	}
	else {
		if(($user->isEmail($email)) && ($user->isImage($avatar)) && ($email !== '') && ($bio !== '') && ($skin !== '') && ($avatar !== '') && ($password !== ''))
			if(($user->isEmailUsed($username[0]->nickname, $email)) || (md5($password) !== $username[0]->password)) {
				$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo. Controlla che l\'indirizzo email da te dato non sia già in uso e che la password sia corretta.');
				if($config[0]->log == 1)
						$user->log($username[0]->nickname, 'Profile modification failed.');
			}
			elseif(($user->editUser('email', $email, $username[0]->nickname)) && ($user->editUser('bio', $bio, $username[0]->nickname)) && ($user->editUser('skin', $skin, $username[0]->nickname)) && ($user->editUser('avatar', $avatar, $username[0]->nickname))) {
				$rendering->addValue('result', 'Il profilo è stato modificato con successo. Attendi per il redirect...'.header('Refresh: 2; URL=profilo.php?nickname='.$username[0]->nickname));
				if($config[0]->log == 1)
						$user->log($username[0]->nickname, 'Profile modificated.');
			}
			else {
				$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo.');
				if($config[0]->log == 1)
						$user->log($username[0]->nickname, 'Profile modification failed.');
			}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la modifica del profilo. Controlla di aver inserito un indirizzo email e un avatar validi e di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Devi effettuare l\'accesso prima di poter modificare il tuo profilo.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificaprofilo.tpl');
