<?php
/**
	/recuperapassword.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$codiceRecupero = ((isset($_GET['codice'])) && ($_GET['codice'] !== '')) ? $user->purge($_GET['codice']) : '';
$recupero = ($codiceRecupero !== '') ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', 'Recupera password &raquo; '.$user->config[0]->nomesito);
$rendering->addValue('keywords', $user->config[0]->keywords);
$rendering->addValue('description', $user->config[0]->description);

if(!$logged) {
	if(($email == '') && ($recupero) && ($codiceRecupero !== '')) {
		$username = $user->searchUserByField('codicerecupero', $codiceRecupero);
		if(!$username)
			$rendering->addValue('result', 'Il codice per il recupero da te inserito non è valido.');
			if($user->config[0]->log == 1)
				$user->log('~', 'Invalid recover code.');
			$rendering->addValue('recupera', '');
		}
		elseif($username[0]->codicerecupero == $codiceRecupero) {
			$codice = $user->getCode();
			$len = strlen($codice);
			$password = substr($codice, $len-24); // 32-24=8
			$nickname = $username[0]->nickname;
			if(($user->editUser('codicerecupero', '', $nickname)) && ($user->editUser('password', md5($password), $nickname))) {
				if($user->config[0]->log == 1)
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
		$username = $user->searchUserByField('email', $email) !== false;
		if($username !== false) {
			if($username[0]->email == $email) {
				$nickname = $username[0]->nickname;
				$codice = $user->getCode();
				if($user->editUser('codicerecupero', $codice, $nickname))
					if($codice !== '') {
						mail($email, $user->config[0]->nomesito.' @ Recupero password per '.$nickname.'.', 'Ciao '.$nickname.',
dal momento che hai perso la tua password attuale, il sistema ne ha generata una casualmente.
Per attivarla, ti basta cliccare il seguente link: '.$user->config[0]->url_index.'/recuperapassword.php?codice='.$codice.'

Se non sei tu '.$nickname.' oppure semplicemente non hai richiesto una nuova password, ignora questa email.

Il webmaster di '.$user->config[0]->nomesito.'.');
						$rendering->addValue('result', 'È stata inviata una email all\'indirizzo da te dato per aiutarti a recuperare la password.');
						if($user->config[0]->log == 1)
							$user->log($nickname, 'Recover mail sended.');
					}
					else {
						$rendering->addValue('result', 'È accaduto un problema durante il recupero della password.');
						if($user->config[0]->log == 1)
							$user->log('~', 'Password recovery failed.');
					}
				else {
					$rendering->addValue('result', 'È accaduto un problema durante il recupero della password.');
					if($user->config[0]->log == 1)
						$user->log('~', 'Password recovery failed.');
				}					
			}
			else {
				$rendering->addValue('result', 'L\'email da immessa non corrisponde a nessun utente attualmente registrato.');
				if($user->config[0]->log == 1)
					$user->log('~', 'Recover mail was not sended.');
			}
		}
		else {
			$rendering->addValue('result', 'L\'email da immessa non corrisponde a nessun utente attualmente registrato.');
			if($user->config[0]->log == 1)
				$user->log('~', 'Recover mail was not sended.');
		}
	else {
		$rendering->addValue('result', 'È accaduto un problema durante la modifica della password. Controlla di aver inserito correttamente l\'indirizzo email.');
		if($user->config[0]->log == 1)
			$user->log('~', 'Recover mail was not sended.');
	}
}
else
	$rendering->addValue('result', 'Se hai già effettuato l\'accesso non hai bisogno di recuperare la tua password.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('recuperapassword.tpl');
