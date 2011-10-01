<?php
/**
	/registrazione.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.ReCaptcha.php');

$ocarina = new Ocarina();
$captcha = new ReCaptcha();
$nickname = ((isset($_POST['nickname'])) && (trim($_POST['nickname']) !== '')) ? $ocarina->purge($_POST['nickname']) : '';
$password = ((isset($_POST['password'])) && (trim($_POST['password']) !== '')) ? $ocarina->purge($_POST['password']) : '';
$confPassword = ((isset($_POST['confPassword'])) && (trim($_POST['confPassword']) !== '')) ? $ocarina->purge($_POST['confPassword']) : '';
$email = ((isset($_POST['email'])) && (trim($_POST['email']) !== '')) ? $ocarina->purge($_POST['email']) : '';
$submit = isset($_POST['submit']) ? true : false;
$codiceRegistrazione = ((isset($_GET['codice'])) && (trim($_GET['codice']) !== '')) ? $ocarina->purge($_GET['codice']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 8).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 8));

if($ocarina->isLogged())
	$ocarina->addValue('result', $ocarina->getLanguage('registration', 0));
elseif($codiceRegistrazione !== '') {
	if($ocarina->config[0]->validazioneaccount == 0)
		$ocarina->addValue('result', $ocarina->getLanguage('registration', 1));
	else
		if(!$ocarina->username = $ocarina->searchUserByField('codiceregistrazione', $codiceRegistrazione)) {
			if($ocarina->config[0]->log == 1)
				$ocarina->log('~', 'Invalid validation code.');
			$ocarina->addValue('result', $ocarina->getLanguage('registration', 2));
		}
		elseif($ocarina->username[0]->codiceregistrazione == $codiceRegistrazione) {
			if($ocarina->editUser('codiceregistrazione', '', $ocarina->username[0]->nickname)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log('~', 'Validation account complete.');
				$ocarina->addValue('result', $ocarina->getLanguage('registration', 3).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/login.php'));
			}
			else {
				if($ocarina->config[0]->$ocarina->addValue('result', $ocarina->getLanguage('registration', 11)) == 1)
					$ocarina->log('~', 'Validation account failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('registration', 4));
			}		
		}
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('registration', 2));
			if($ocarina->config[0]->log == 1)
				$ocarina->log('~', 'Invalid validation code.');
		}
}
elseif($submit) {
	if($ocarina->config[0]->registrazioni == 0)
		$ocarina->addValue('result', $ocarina->getLanguage('registration', 5));
	elseif(($nickname !== '') && ($password !== '') && ($confPassword !== '') && ($email !== '')) {
		$captcha->checkCaptcha();
		if($captcha->getError() !== false)
			$ocarina->addValue('result', $ocarina->getLanguage('registration', 12));
		elseif(($password == $confPassword) && (strlen($password) > 4) && (strlen($nickname) > 4)) {
			if($ocarina->config[0]->validazioneaccount == 1) {
				$codice = $ocarina->getCode(); // Validazione account
				$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), $codice, $ocarina->config[0]->skin);
				if($ocarina->createUser($array)) {
					$ocarina->sendMail($email, $ocarina->config[0]->nomesito.' @ Validazione account per '.$nickname.'.', 'Ciao '.$nickname.',
					dal momento che ti sei registrato, il sistema ha bisogno di essere sicuro che la tua email sia valida.
					Per validarla ti basta cliccare il seguente link: '.$ocarina->config[0]->url_index.'/registrazione.php?codice='.$codice.'

					Se non sei tu '.$nickname.', ignora questa email.

					Il webmaster di '.$ocarina->config[0]->nomesito.'.');
					$ocarina->addValue('result', $ocarina->getLanguage('registration', 6).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/login.php'));
					if($ocarina->config[0]->log == 1)
						$ocarina->log($nickname, 'Registrated.');
				}
				else {
					$ocarina->addValue('result', $ocarina->getLanguage('registration', 7));
					if($ocarina->config[0]->log == 1)
						$ocarina->log($nickname, 'Registration failed.');
				}
			}
			else {
				$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), '', $ocarina->config[0]->skin);
				if($ocarina->createUser($array)) {
					$ocarina->addValue('result', $ocarina->getLanguage('registration', 8).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/login.php'));
					if($ocarina->config[0]->log == 1)
						$ocarina->log($nickname, 'Registrated.');
				}
				else {
					$ocarina->addValue('result', $ocarina->getLanguage('registration', 9));
					if($ocarina->config[0]->log == 1)
						$ocarina->log($nickname, 'Registration failed.');
				}
			}
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('registration', 10));
	}
	else
		$ocarina->addValue('result', $ocarina->getLanguage('registration', 11));
}
elseif(!$submit)
	$ocarina->addValue('captcha', $captcha->getCaptcha());
$ocarina->addValue('codiceRegistrazione', $codiceRegistrazione);
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('registrazione.tpl');
