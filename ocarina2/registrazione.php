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
$codiceRegistrazione = ((isset($_GET['codice'])) && ($_GET['codice'] !== '')) ? $user->purge($_GET['codice']) : '';

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', $user->getLanguage('title', 8).$user->getLanguage('title', 2).$user->config[0]->nomesito);
$rendering->addValue('description', $user->getLanguage('description', 8));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());

if($user->isLogged())
	$rendering->addValue('result', $user->getLanguage('registration', 0));
elseif($codiceRegistrazione !== '') {
	if($user->config[0]->validazioneaccount == 0)
		$rendering->addValue('result', $user->getLanguage('registration', 1));
	else {
		$user->username = $user->searchUserByField('codiceregistrazione', $codiceRegistrazione);
		if(!$user->username) {
			if($user->config[0]->log == 1)
				$user->log('~', 'Invalid validation code.');
			$rendering->addValue('result', $user->getLanguage('registration', 2));
		}
		elseif($user->username[0]->codiceregistrazione == $codiceRegistrazione) {
			if($user->editUser('codiceregistrazione', '', $user->username[0]->nickname)) {
				if($user->config[0]->log == 1)
					$user->log('~', 'Validation account complete.');
				$rendering->addValue('result', $user->getLanguage('registration', 3).header('Refresh: 2; URL='.$user->config[0]->url_index.'/login.php'));
			}
			else {
				if($user->config[0]->log == 1)
					$user->log('~', 'Validation account failed.');
				$rendering->addValue('result', $user->getLanguage('registration', 4));
			}		
		}
		else {
			$rendering->addValue('result', $user->getLanguage('registration', 2));
			if($user->config[0]->log == 1)
				$user->log('~', 'Invalid validation code.');
		}
	}
}
elseif($submit) {
	if($user->config[0]->registrazioni == 0)
		$rendering->addValue('result', $user->getLanguage('registration', 5));
	elseif(($nickname !== '') && ($password !== '') && ($confPassword !== '') && ($email !== '')) {
		if((($password == $confPassword) && (strlen($password) > 4)) || (strlen($nickname) > 4)) {
			unset($confPassword);
			if($user->config[0]->validazioneaccount == 1) {
				$codice = $user->getCode(); // Validazione account
				$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), $codice, $user->config[0]->skin);
				if($user->createUser($array)) {
					$user->sendMail($email, $user->config[0]->nomesito.' @ Validazione account per '.$nickname.'.', 'Ciao '.$nickname.',
					dal momento che ti sei registrato, il sistema ha bisogno di essere sicuro che la tua email sia valida.
					Per validarla ti basta cliccare il seguente link: '.$user->config[0]->url_index.'/registrazione.php?codice='.$codice.'

					Se non sei tu '.$nickname.', ignora questa email.

					Il webmaster di '.$user->config[0]->nomesito.'.');
					$rendering->addValue('result', $user->getLanguage('registration', 6).header('Refresh: 2; URL='.$user->config[0]->url_index.'/login.php'));
					if($user->config[0]->log == 1)
						$user->log($nickname, 'Registrated.');
				}
				else {
					$rendering->addValue('result', $user->getLanguage('registration', 7));
					if($user->config[0]->log == 1)
						$user->log($nickname, 'Registration failed.');
				}
			}
			else {
				$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), '', $user->config[0]->skin);
				if($user->createUser($array)) {
					$rendering->addValue('result', $user->getLanguage('registration', 8).header('Refresh: 2; URL='.$user->config[0]->url_index.'/login.php'));
					if($user->config[0]->log == 1)
						$user->log($nickname, 'Registrated.');
				}
				else {
					$rendering->addValue('result', $user->getLanguage('registration', 9));
					if($user->config[0]->log == 1)
						$user->log($nickname, 'Registration failed.');
				}
			}
		}
		else
			$rendering->addValue('result', $user->getLanguage('registration', 10));
	}
	else
		$rendering->addValue('result', $user->getLanguage('registration', 11));
}
$rendering->addValue('codiceRegistrazione', $codiceRegistrazione);
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('registrazione.tpl');
