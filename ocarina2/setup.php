<?php
/**
	/setup.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Rendering.php');
$rendering = new Rendering();
$submit = isset($_POST['submit']) ? true : false;
$reg = isset($_POST['reg']) ? true : false;

if($reg) {
	$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $rendering->purge($_POST['nickname']) : '';
	$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $rendering->purge($_POST['password']) : '';
	$confPassword = ((isset($_POST['confPassword'])) && ($_POST['confPassword'] !== '')) ? $rendering->purge($_POST['confPassword']) : '';
	$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $rendering->purge($_POST['email']) : '';
	
	if((($password == $confPassword) && (strlen($password) > 4)) || (strlen($nickname) > 4)) {
		$array = array($nickname, $password, $email, 1, date('d-m-y'), date('G:m:s'), $rendering->getCode(), $rendering->config[0]->skin);
		if($rendering->createUser($array)) {
			$rendering->sendMail($email, $rendering->config[0]->nomesito.' @ Validazione account per '.$nickname.'.', 'Ciao '.$nickname.',
			dal momento che ti sei registrato, il sistema ha bisogno di essere sicuro che la tua email sia valida.
			Per validarla ti basta cliccare il seguente link: '.$rendering->config[0]->url_index.'/registrazione.php?codice='.$codice.'

			Se non sei tu '.$nickname.', ignora questa email.

			Il webmaster di '.$rendering->config[0]->nomesito.'.');
			echo '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<title>Setup &raquo; Ocarina2 CMS</title>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			</head>
			<body>
			<div align="center"><h1>Registrazione completata.<br />Hai bisogno però di confermare l\'email.</h1></div>
			</body>
			</html>';
		}
		else
			echo '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<title>Setup &raquo; Ocarina2 CMS</title>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			</head>
			<body>
			<div align="center"><h1>Registrazione completata</h1></div>
			</body>
			</html>';
	}
}
elseif($submit) {
	$nomesito = ((isset($_POST['nomesito'])) && ($_POST['nomesito'] !== '')) ? $rendering->purge($_POST['nomesito']) : '';
	$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $rendering->purge($_POST['email']) : '';
	$bbcode = ((isset($_POST['bbcode'])) && (is_numeric($_POST['bbcode'])) && ($_POST['bbcode'] !== '')) ? $rendering->purge((int)$_POST['bbcode']) : '';
	$registrazioni = ((isset($_POST['registrazioni'])) && (is_numeric($_POST['registrazioni'])) && ($_POST['registrazioni'] !== '')) ? $rendering->purge((int)$_POST['registrazioni']) : '';
	$validazioneaccount = ((isset($_POST['validazioneaccount'])) && (is_numeric($_POST['validazioneaccount'])) && ($_POST['validazioneaccount'] !== '')) ? $rendering->purge((int)$_POST['validazioneaccount']) : '';
	$commenti = ((isset($_POST['commenti'])) && (is_numeric($_POST['commenti'])) && ($_POST['commenti'] !== '')) ? $rendering->purge((int)$_POST['commenti']) : '';
	$approvacommenti = ((isset($_POST['approvacommenti'])) && (is_numeric($_POST['approvacommenti'])) && ($_POST['approvacommenti'] !== '')) ? $rendering->purge((int)$_POST['approvacommenti']) : '';
	$log = ((isset($_POST['log'])) && (is_numeric($_POST['log'])) && ($_POST['log'] !== '')) ? $rendering->purge((int)$_POST['log']) : '';
	$cookie = ((isset($_POST['cookie'])) && ($_POST['cookie'] !== '')) ? $rendering->purge($_POST['cookie']) : '';
	$loginexpire = ((isset($_POST['loginexpire'])) && ($_POST['loginexpire'] !== '')) ? $rendering->purge($_POST['loginexpire']) : '';
	$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $rendering->purge($_POST['skin']) : '';
	$description = ((isset($_POST['description'])) && ($_POST['description'] !== '')) ? $rendering->purge($_POST['description']) : '';
	$limitenews = ((isset($_POST['limitenews'])) && (is_numeric($_POST['limitenews'])) && ($_POST['limitenews'] !== '')) ? $rendering->purge((int)$_POST['limitenews']) : '';
	$impaginazionenews = ((isset($_POST['impaginazionenews'])) && (is_numeric($_POST['impaginazionenews'])) && ($_POST['impaginazionenews'] !== '')) ? $rendering->purge((int)$_POST['impaginazionenews']) : '';
	$limiteonline = ((isset($_POST['limiteonline'])) && (is_numeric($_POST['limiteonline'])) && ($_POST['limiteonline'] !== '')) ? $rendering->purge((int)$_POST['limiteonline']) : '';
	$permettivoto = ((isset($_POST['permettivoto'])) && (is_numeric($_POST['permettivoto'])) && ($_POST['permettivoto'] !== '')) ? $rendering->purge((int)$_POST['permettivoto']) : '';
	$url = ((isset($_POST['url'])) && ($_POST['url'] !== '')) ? $rendering->purge($_POST['url']) : '';
	$url_index = ((isset($_POST['url_index'])) && ($_POST['url_index'] !== '')) ? $rendering->purge($_POST['url_index']) : '';
	$url_admin = ((isset($_POST['url_admin'])) && ($_POST['url_admin'] !== '')) ? $rendering->purge($_POST['url_admin']) : '';
	$url_rendering = ((isset($_POST['url_rendering'])) && ($_POST['url_rendering'] !== '')) ? $rendering->purge($_POST['url_rendering']) : '';
	$url_immagini = ((isset($_POST['url_immagini'])) && ($_POST['url_immagini'] !== '')) ? $rendering->purge($_POST['url_immagini']) : '';
	$root = ((isset($_POST['root'])) && ($_POST['root'] !== '')) ? $rendering->purge($_POST['root']) : '';
	$root_index = ((isset($_POST['root_index'])) && ($_POST['root_index'] !== '')) ? $rendering->purge($_POST['root_index']) : '';
	$root_admin = ((isset($_POST['root_admin'])) && ($_POST['root_admin'] !== '')) ? $rendering->purge($_POST['root_admin']) : '';
	$root_rendering = ((isset($_POST['root_rendering'])) && ($_POST['root_rendering'] !== '')) ? $rendering->purge($_POST['root_rendering']) : '';
	$root_immagini = ((isset($_POST['root_immagini'])) && ($_POST['root_immagini'] !== '')) ? $rendering->purge($_POST['root_immagini']) : '';
	
	$array = array($nomesito, $email, $bbcode, $registrazioni, $validazioneaccount, $commenti, $approvacommenti, $log, $cookie, $loginexpire, $skin, $description, $limitenews, $impaginazionenews, $limitenews, $permettivoto, $url, $url_index, $url_admin, $url_rendering, $url_immagini, $root, $root_index, $root_admin, $root_rendering, $root_immagini);
	if($rendering->createConfig($array))
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Setup &raquo; Ocarina2 CMS</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<div align="center"><h1>Setup completato</h1></div>
	<form action="" method="post">
	<table border="0">
	<tr>
	<td>
	Nickname<br />
	<input type="text" name="nickname" /><br />
	</td>
	<td>
	Password<br />
	<input type="password" name="password" /><br />
	</td>
	<td>
	Conferma password<br />
	<input type="password" name="confPassword" /><br />
	</td>
	<td>
	Email<br />
	<input type="text" name="email" /><br />
	</td>
	</table>
	<br />
	<input type="submit" value="Registrati come amministratore" name="submit" />
	</form>
	</body>
	</html>';
	else
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Setup &raquo; Ocarina2 CMS</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<div align="center"><h1>È accaduto un errore durante il setup.</h1></div>
	</body>
	</html>';	
}
else {
	echo  '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Setup &raquo; Ocarina2 CMS</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<div align="center"><h1>Setup &raquo; Ocarina2 CMS</h1></div>
	Benvenuto nel setup di Ocarina2.<br />
	Per prima cosa modifica il file <i>class.MySQL.php</i> della cartella <i>core</i>, inserendo nelle righe 10-13 i dati riguardanti il database (host, username, password e nome del database), e nella 16 un prefisso per le tabelle del database, il più complesso possibile (ex.: asdfghjk12345).<br />
	Una volta salvato il file, compila il seguente form con ciò che è richiesto dalle righe sovrastanti, e poni attenzione nella sezione riguardante i percorsi, stando attento agli slash (<i>/</i>), come riportato negli eventuali esempi.<br />
	In caso la directory di installazione non sia /ocarina2, modificala correttamente nelle righe 9-12 del file <i>.htaccess</i>.<br />
	Subito dopo l\'invio della configurazione, ti verrà presentato un form per registrarti come amministratore, dopodichè ti basterà eliminare questo file (<i>setup.php</i>).
	<p align="right">Buon proseguimento con Ocarina,<br />
	<i>Giovanni Capuano</i></p><br />
	
	<form action="" method="post">
	<b>Nome del sito</b><br />
	<input type="text" name="nomesito" maxlength="100" /><br /><br />

	<b>Email</b><br />
	<input type="text" name="email" maxlength="100" /><br /><br />

	<b>Attiva BBCode (0 = No, 1 = Si)</b><br />
	<input type="text" name="bbcode" maxlength="1" /><br /><br />

	<b>Permetti registrazioni (0 = No, 1 = Si)</b><br />
	<input type="text" name="registrazioni" maxlength="1" /><br /><br />

	<b>Validazione account con conferma email (0 = No, 1 = Si)</b><br />
	<input type="text" name="validazioneaccount" maxlength="1" /><br /><br />

	<b>Abilita commenti (0 = No, 1 = Si)</b><br />
	<input type="text" name="commenti" maxlength="1" /><br /><br />

	<b>Approva commenti automaticamente (0 = Si, 1 = No)</b><br />
	<input type="text" name="approvacommenti" maxlength="1" /><br /><br />

	<b>Registra log automaticamente (0 = No, 1 = Si)</b><br />
	<input type="text" name="log" maxlength="1" /><br /><br />

	<b>Nome del cookie</b><br />
	<input type="text" name="cookie" maxlength="20" /><br /><br />

	<b>Durata login in secondi (ex.: 3600 = 1 ora, 1296000 = 15 giorni)</b><br />
	<input type="text" name="loginexpire" maxlength="20" /><br /><br />

	<b>Skin di default</b><br />
	<select name="skin">
	';
	$listaskin = $rendering->getSkinList();
	foreach($listaskin as $v)
		echo  '<option value="'.$v.'">'.$v.'</option>
	';
	echo  '</select><br /><br />

	<b>Breve descrizione del sito</b><br />
	<input type="text" name="description" maxlength="151" /><br /><br />

	<b>Limite caratteri news</b><br />
	<input type="text" name="limitenews" maxlength="10" /><br /><br />

	<b>News da mostrare per pagina</b><br />
	<input type="text" name="impaginazionenews" maxlength="10" /><br /><br />

	<b>Minuti per i quali un utente è considerato online finchè non compie un\'azione</b><br />
	<input type="text" name="limiteonline" maxlength="10" /><br /><br />

	<b>Permetti i voti alle news</b><br />
	<input type="text" name="permettivoto" maxlength="10" /><br /><br />

	<b>URL (ex.: http://www.tuosito.com)</b><br />
	<input type="text" name="url" maxlength="100" /><br /><br />

	<b>URL index (ex.: http://www.tuosito.com/ocarina2)</b><br />
	<input type="text" name="url_index" maxlength="100" /><br /><br />

	<b>URL admin (ex.: http://www.tuosito.com/ocarina2/admin)</b><br />
	<input type="text" name="url_admin" maxlength="100" /><br /><br />

	<b>URL rendering (ex.: http://www.tuosito.com/ocarina2/rendering/)</b><br />
	<input type="text" name="url_rendering" maxlength="100" /><br /><br />

	<b>URL immagini (ex.: http://www.tuosito.com/ocarina2/immagini)</b><br />
	<input type="text" name="url_immagini" maxlength="100" /><br /><br />

	<b>Root (ex.: /var/www/htdocs)</b><br />
	<input type="text" name="root" maxlength="100" /><br /><br />

	<b>Root index (ex.: /var/www/htdocs/ocarina2)</b><br />
	<input type="text" name="root_index" maxlength="100" /><br /><br />

	<b>Root admin (ex.: /var/www/htdocs/ocarina2/admin)</b><br />
	<input type="text" name="root_admin" maxlength="100" /><br /><br />

	<b>Root rendering (ex.: /var/www/htdocs/ocarina2/rendering)</b><br />
	<input type="text" name="root_rendering" maxlength="100" /><br /><br />

	<b>Root immagini (ex.: /var/www/htdocs/ocarina2/immagini)</b><br />
	<input type="text" name="root_immagini" maxlength="100" /><br /><br />

	<input type="submit" name="submit" value="Installa" />
	</form>

	</body>
	</html>';
}
