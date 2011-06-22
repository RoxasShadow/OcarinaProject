<?php
/**
	/recuperapassword.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$codiceRecupero = ((isset($_GET['codice'])) && ($_GET['codice'] !== '')) ? $user->purge($_GET['codice']) : '';
$recupero = ($codiceRecupero !== '') ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', 'Recupera password &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if(!$logged) {
	if(($email == '') && ($recupero) && ($codiceRecupero !== '')) {
		if($user->searchUserByField('codicerecupero', $codiceRecupero) !== false)
			$username = $user->searchUserByField('codicerecupero', $codiceRecupero);
		else {
			$rendering->addValue('result', 'Il codice per il recupero da te inserito non è valido.');
			if($config[0]->log == 1)
				$user->log('~', 'Invalid recover code.');
			$rendering->addValue('logged', $logged);
			$rendering->addValue('recupera', '');
			$rendering->renderize('recuperapassword.tpl');
			exit();
		}
		if($username[0]->codicerecupero == $codiceRecupero) {
			$codice = $user->getCode();
			$len = strlen($codice);
			$password = substr($codice, $len-24); // 32-24=8
			$nickname = $username[0]->nickname;
			if(($user->editUser('codicerecupero', '', $nickname)) && ($user->editUser('password', md5($password), $nickname))) {
				if($config[0]->log == 1)
					$user->log($nickname, 'Password recovered.');
				$rendering->addValue('result', 'La tua nuova password è '.$password.'. Se vuoi, puoi modificarla dopo aver effettuato l\accesso.');
				$rendering->addValue('recupera', '');
			}
			else {
				$rendering->addValue('result', 'È accaduto un problema durante la reimpostazione della password.');
				$rendering->addValue('recupera', '');
			}
		}
		else
			$rendering->addValue('result', 'Il codice per il recupero da te inserito non è valido.');
	}
	elseif(($email !== '') && (!$recupero))
		if($user->searchUserByField('email', $email) !== false) {
			$username = $user->searchUserByField('email', $email);
			if($username[0]->email == $email) {
				$nickname = $username[0]->nickname;
				$codice = $user->getCode();
				if($user->editUser('codicerecupero', $codice, $nickname))
					if($codice !== '') {
						mail($email, $config[0]->nomesito.' @ Recupero password per '.$nickname.'.', 'Ciao '.$nickname.',
dal momento che hai perso la tua password attuale, il sistema ne ha generata una casualmente.
Per attivarla, ti basta cliccare il seguente link: '.$config[0]->url_index.'/recuperapassword.php?codice='.$codice.'

Se non sei tu '.$nickname.' oppure semplicemente non hai richiesto una nuova password, ignora questa email.

Il webmaster di '.$config[0]->nomesito.'.');
						$rendering->addValue('result', 'È stata inviata una email all\'indirizzo da te dato per aiutarti a recuperare la password.');
						if($config[0]->log == 1)
							$user->log($nickname, 'Recover mail sended.');
					}
					else {
						$rendering->addValue('result', 'È accaduto un problema durante il recupero della password.');
						if($config[0]->log == 1)
							$user->log('~', 'Password recovery failed.');
					}
				else {
					$rendering->addValue('result', 'È accaduto un problema durante il recupero della password.');
					if($config[0]->log == 1)
						$user->log('~', 'Password recovery failed.');
				}					
			}
			else {
				$rendering->addValue('result', 'L\'email da immessa non corrisponde a nessun utente attualmente registrato.');
				if($config[0]->log == 1)
					$user->log('~', 'Recover mail was not sended.');
			}
		}
		else {
			$rendering->addValue('result', 'L\'email da immessa non corrisponde a nessun utente attualmente registrato.');
			if($config[0]->log == 1)
				$user->log('~', 'Recover mail was not sended.');
		}
	else {
		$rendering->addValue('result', 'È accaduto un problema durante la modifica della password. Controlla di aver inserito correttamente l\'indirizzo email.');
		if($config[0]->log == 1)
			$user->log('~', 'Recover mail was not sended.');
	}
}
else
	$rendering->addValue('result', 'Se hai già effettuato l\'accesso non hai bisogno di recuperare la tua password.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('recuperapassword.tpl');
