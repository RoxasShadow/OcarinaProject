<?php
/**
	/recuperapassword.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.ReCaptcha.php');

$ocarina = new Ocarina();
$captcha = new ReCaptcha();
$email = ((isset($_POST['email'])) && (trim($_POST['email']) !== '')) ? $ocarina->purge($_POST['email']) : '';
$codiceRecupero = ((isset($_GET['codice'])) && (trim($_GET['codice']) !== '')) ? $ocarina->purge($_GET['codice']) : '';
$recupero = ($codiceRecupero !== '') ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 7).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 7));

if(!$submit) {
	$ocarina->addValue('captcha', $captcha->getCaptcha());
	$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 8));
}
elseif(!$ocarina->isLogged())
	if(($email == '') && ($recupero) && ($codiceRecupero !== ''))
		if(!$ocarinaname = $ocarina->searchUserByField('codicerecupero', $codiceRecupero)) {
			$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 0));
			if($ocarina->config[0]->log == 1)
				$ocarina->log('~', 'Invalid recover code.');
			$ocarina->addValue('recupera', '');
		}
		elseif($ocarinaname[0]->codicerecupero == $codiceRecupero) {
			$codice = $ocarina->getCode();
			$password = substr($codice, strlen($codice)-24); // 32-24=8
			if(($ocarina->editUser('codicerecupero', '', $ocarinaname[0]->nickname)) && ($ocarina->editUser('password', md5($password), $ocarinaname[0]->nickname))) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarinaname[0]->nickname, 'Password recovered.');
				$ocarina->addValue('result', str_replace('{$password}', $password, $ocarina->getLanguage('recoverpassword', 1)));
				$ocarina->addValue('recupera', '');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 2));
				$ocarina->addValue('recupera', '');
			}
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 3));
	elseif(($email !== '') && (!$recupero)) {
		$captcha->checkCaptcha();
		if($captcha->getError() !== false)
			$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 9));
		else
			if(($ocarinaname = $ocarina->searchUserByField('email', $email)) !== false) {
				if($ocarinaname[0]->email == $email) {
					$nickname = $ocarinaname[0]->nickname;
					$codice = $ocarina->getCode();
					if($ocarina->editUser('codicerecupero', $codice, $nickname))
						if($codice !== '') {
							$ocarina->sendMail($email, $ocarina->config[0]->nomesito.' @ Recupero password per '.$nickname.'.', 'Ciao '.$nickname.',
	dal momento che hai perso la tua password attuale, il sistema ne ha generata una casualmente.
	Per attivarla, ti basta cliccare il seguente link: '.$ocarina->config[0]->url_index.'/recuperapassword.php?codice='.$codice.'

	Se non sei tu '.$nickname.' oppure semplicemente non hai richiesto una nuova password, ignora questa email.

	Il webmaster di '.$ocarina->config[0]->nomesito.'.');
							$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 4));
							if($ocarina->config[0]->log == 1)
								$ocarina->log($nickname, 'Recover mail sended.');
						}
						else {
							$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 5));
							if($ocarina->config[0]->log == 1)
								$ocarina->log('~', 'Password recovery failed.');
						}
					else {
						$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 5));
						if($ocarina->config[0]->log == 1)
							$ocarina->log('~', 'Password recovery failed.');
					}					
				}
				else {
					$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 6));
					if($ocarina->config[0]->log == 1)
						$ocarina->log('~', 'Recover mail was not sended.');
				}
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 6));
				if($ocarina->config[0]->log == 1)
					$ocarina->log('~', 'Recover mail was not sended.');
			}
	}
	else {
		$ocarina->addValue('result', $ocarina->getLanguage('recoverpassword', 7));
		if($ocarina->config[0]->log == 1)
			$ocarina->log('~', 'Recover mail was not sended.');
	}
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('recuperapassword.tpl');
