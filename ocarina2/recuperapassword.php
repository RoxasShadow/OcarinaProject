<?php
/**
	/recuperapassword.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');
require_once('etc/class.ReCaptcha.php');

$user = new User();
$rendering = new Rendering();
$captcha = new ReCaptcha();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$codiceRecupero = ((isset($_GET['codice'])) && ($_GET['codice'] !== '')) ? $user->purge($_GET['codice']) : '';
$recupero = ($codiceRecupero !== '') ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', $user->getLanguage('title', 7).$user->getLanguage('title', 2).$user->config[0]->nomesito);
$rendering->addValue('description', $user->getLanguage('description', 7));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $user->getTotalVisits());

if(!$submit) {
	$rendering->addValue('captcha', $captcha->getCaptcha());
	$rendering->addValue('result', $user->getLanguage('recoverpassword', 8));
}
elseif(!$user->isLogged())
	if(($email == '') && ($recupero) && ($codiceRecupero !== '')) {
		$username = $user->searchUserByField('codicerecupero', $codiceRecupero);
		if(!$username) {
			$rendering->addValue('result', $user->getLanguage('recoverpassword', 0));
			if($user->config[0]->log == 1)
				$user->log('~', 'Invalid recover code.');
			$rendering->addValue('recupera', '');
		}
		elseif($username[0]->codicerecupero == $codiceRecupero) {
			$codice = $user->getCode();
			$password = substr($codice, strlen($codice)-24); // 32-24=8
			if(($user->editUser('codicerecupero', '', $username[0]->nickname)) && ($user->editUser('password', md5($password), $username[0]->nickname))) {
				if($user->config[0]->log == 1)
					$user->log($username[0]->nickname, 'Password recovered.');
				$rendering->addValue('result', str_replace('{$password}', $password, $user->getLanguage('recoverpassword', 1)));
				$rendering->addValue('recupera', '');
			}
			else {
				$rendering->addValue('result', $user->getLanguage('recoverpassword', 2));
				$rendering->addValue('recupera', '');
			}
		}
		else
			$rendering->addValue('result', $user->getLanguage('recoverpassword', 3));
	}
	elseif(($email !== '') && (!$recupero)) {
		$captcha->checkCaptcha();
		if($captcha->getError() !== false)
			$rendering->addValue('result', $user->getLanguage('recoverpassword', 9));
		else {
			$username = $user->searchUserByField('email', $email);
			if($username !== false) {
				if($username[0]->email == $email) {
					$nickname = $username[0]->nickname;
					$codice = $user->getCode();
					if($user->editUser('codicerecupero', $codice, $nickname))
						if($codice !== '') {
							$user->sendMail($email, $user->config[0]->nomesito.' @ Recupero password per '.$nickname.'.', 'Ciao '.$nickname.',
	dal momento che hai perso la tua password attuale, il sistema ne ha generata una casualmente.
	Per attivarla, ti basta cliccare il seguente link: '.$user->config[0]->url_index.'/recuperapassword.php?codice='.$codice.'

	Se non sei tu '.$nickname.' oppure semplicemente non hai richiesto una nuova password, ignora questa email.

	Il webmaster di '.$user->config[0]->nomesito.'.');
							$rendering->addValue('result', $user->getLanguage('recoverpassword', 4));
							if($user->config[0]->log == 1)
								$user->log($nickname, 'Recover mail sended.');
						}
						else {
							$rendering->addValue('result', $user->getLanguage('recoverpassword', 5));
							if($user->config[0]->log == 1)
								$user->log('~', 'Password recovery failed.');
						}
					else {
						$rendering->addValue('result', $user->getLanguage('recoverpassword', 5));
						if($user->config[0]->log == 1)
							$user->log('~', 'Password recovery failed.');
					}					
				}
				else {
					$rendering->addValue('result', $user->getLanguage('recoverpassword', 6));
					if($user->config[0]->log == 1)
						$user->log('~', 'Recover mail was not sended.');
				}
			}
			else {
				$rendering->addValue('result', $user->getLanguage('recoverpassword', 6));
				if($user->config[0]->log == 1)
					$user->log('~', 'Recover mail was not sended.');
			}
		}
	}
	else {
		$rendering->addValue('result', $user->getLanguage('recoverpassword', 7));
		if($user->config[0]->log == 1)
			$user->log('~', 'Recover mail was not sended.');
	}
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('recuperapassword.tpl');
