<?php
/**
	/setup.php
	(C) Giovanni Capuano 2011
*/
$submit = isset($_POST['submit']) ? true : false;
$reg = isset($_POST['reg']) ? true : false;
$versione = '0.9';

if($reg) {
	require_once('core/class.User.php');
	$config = new User();
	$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $config->purge($_POST['nickname']) : '';
	$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $config->purge($_POST['password']) : '';
	$confPassword = ((isset($_POST['confPassword'])) && ($_POST['confPassword'] !== '')) ? $config->purge($_POST['confPassword']) : '';
	$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $config->purge($_POST['email']) : '';
	
	if(($password == $confPassword) && (strlen($password) > 4) && (strlen($nickname) > 4))
		if($config->createUser(array($nickname, $password, $email, 1, date('d-m-y'), date('G:m:s'), '', $config->config[0]->skin)))
			echo '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<title>Setup &raquo; Ocarina2 CMS</title>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			</head>
			<body>
			<div align="center"><h1>Registrazione completata.<br />Ora elimina il file <b>setup.php</b></div>
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
			<div align="center"><h1>Registrazione fallita.</h1></div>
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
		<div align="center"><h1>Registrazione fallita.<br />Le due password non corrispondono, oppure il nickname o la password ha meno di 5 caratteri.</h1></div>
		</body>
		</html>';
}
elseif($submit) {
	require_once('core/class.Configuration.php');
	$config = new Configuration();
	$nomesito = ((isset($_POST['nomesito'])) && ($_POST['nomesito'] !== '')) ? $config->purge($_POST['nomesito']) : '';
	$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $config->purge($_POST['email']) : '';
	$registrazioni = ((isset($_POST['registrazioni'])) && (is_numeric($_POST['registrazioni'])) && ($_POST['registrazioni'] !== '')) ? $config->purge((int)$_POST['registrazioni']) : '';
	$validazioneaccount = ((isset($_POST['validazioneaccount'])) && (is_numeric($_POST['validazioneaccount'])) && ($_POST['validazioneaccount'] !== '')) ? $config->purge((int)$_POST['validazioneaccount']) : '';
	$commenti = ((isset($_POST['commenti'])) && (is_numeric($_POST['commenti'])) && ($_POST['commenti'] !== '')) ? $config->purge((int)$_POST['commenti']) : '';
	$approvacommenti = ((isset($_POST['approvacommenti'])) && (is_numeric($_POST['approvacommenti'])) && ($_POST['approvacommenti'] !== '')) ? $config->purge((int)$_POST['approvacommenti']) : '';
	$log = ((isset($_POST['log'])) && (is_numeric($_POST['log'])) && ($_POST['log'] !== '')) ? $config->purge((int)$_POST['log']) : '';
	$plugin = ((isset($_POST['plugin'])) && (is_numeric($_POST['plugin'])) && ($_POST['plugin'] !== '')) ? $config->purge((int)$_POST['plugin']) : '';
	$cookie = ((isset($_POST['cookie'])) && ($_POST['cookie'] !== '')) ? $config->purge($_POST['cookie']) : '';
	$loginexpire = ((isset($_POST['loginexpire'])) && ($_POST['loginexpire'] !== '')) ? $config->purge($_POST['loginexpire']) : '';
	$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $config->purge($_POST['skin']) : '';
	$description = ((isset($_POST['description'])) && ($_POST['description'] !== '')) ? $config->purge($_POST['description']) : '';
	$limitenews = ((isset($_POST['limitenews'])) && (is_numeric($_POST['limitenews'])) && ($_POST['limitenews'] !== '')) ? $config->purge((int)$_POST['limitenews']) : '';
	$impaginazionenews = ((isset($_POST['impaginazionenews'])) && (is_numeric($_POST['impaginazionenews'])) && ($_POST['impaginazionenews'] !== '')) ? $config->purge((int)$_POST['impaginazionenews']) : '';
	$limiteonline = ((isset($_POST['limiteonline'])) && (is_numeric($_POST['limiteonline'])) && ($_POST['limiteonline'] !== '')) ? $config->purge((int)$_POST['limiteonline']) : '';
	$permettivoto = ((isset($_POST['permettivoto'])) && (is_numeric($_POST['permettivoto'])) && ($_POST['permettivoto'] !== '')) ? $config->purge((int)$_POST['permettivoto']) : '';
	$url = ((isset($_POST['url'])) && ($_POST['url'] !== '')) ? $config->purge($_POST['url']) : '';
	$url_index = ((isset($_POST['url_index'])) && ($_POST['url_index'] !== '')) ? $config->purge($_POST['url_index']) : '';
	$url_admin = ((isset($_POST['url_admin'])) && ($_POST['url_admin'] !== '')) ? $config->purge($_POST['url_admin']) : '';
	$url_rendering = ((isset($_POST['url_rendering'])) && ($_POST['url_rendering'] !== '')) ? $config->purge($_POST['url_rendering']) : '';
	$url_immagini = ((isset($_POST['url_immagini'])) && ($_POST['url_immagini'] !== '')) ? $config->purge($_POST['url_immagini']) : '';
	$root = ((isset($_POST['root'])) && ($_POST['root'] !== '')) ? $config->purge($_POST['root']) : '';
	$root_index = ((isset($_POST['root_index'])) && ($_POST['root_index'] !== '')) ? $config->purge($_POST['root_index']) : '';
	$root_admin = ((isset($_POST['root_admin'])) && ($_POST['root_admin'] !== '')) ? $config->purge($_POST['root_admin']) : '';
	$root_rendering = ((isset($_POST['root_rendering'])) && ($_POST['root_rendering'] !== '')) ? $config->purge($_POST['root_rendering']) : '';
	$root_immagini = ((isset($_POST['root_immagini'])) && ($_POST['root_immagini'] !== '')) ? $config->purge($_POST['root_immagini']) : '';
	
	if(!$config->createDatabase()) {
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Setup &raquo; Ocarina2 CMS</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<div align="center"><h1>È accaduto un errore durante la creazione delle tabelle: controlla che i dati del database siano corretti.</h1>'.$cb.'</div>
	</body>
	</html>';
	unset($config);
	die();
	}
	$array = array($nomesito, $email, $registrazioni, $validazioneaccount, $commenti, $approvacommenti, $log, $plugin, $cookie, $loginexpire, $skin, $description, $limitenews, $impaginazionenews, $limitenews, $permettivoto, $url, $url_index, $url_admin, $url_rendering, $url_immagini, $root, $root_index, $root_admin, $root_rendering, $root_immagini, $versione, '0');
	if($config->createConfig($array))
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
	<input type="submit" name="reg" value="Registrati come amministratore" />
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
	unset($config);	
}
else
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
	Per prima cosa modifica il file <i>class.MySQL.php</i> della cartella <i>core</i>, inserendo nelle righe 10-13 i dati riguardanti il database (host, username, password e nome del database), nella 14 un prefisso per le tabelle del database (ex.: ocarina_), nella 15 abilita o meno il caching* (di default è abilitato) e nella 16 inserisci il percorso assoluto della cartella che contiene i file di cache (ex.: '.$_SERVER['DOCUMENT_ROOT'].'ocarina2/cache/).<br />
	In <i>class.Plugin.php</i>, nella riga 13, inserisci il path assoluto di Ocarina (ex.: '.$_SERVER['DOCUMENT_ROOT'].'ocarina2).<br />
	Una volta salvato il file, compila il seguente form con ciò che è richiesto dalle righe sovrastanti, e poni attenzione nella sezione riguardante i percorsi, stando attento agli slash (<i>/</i>), come riportato negli eventuali esempi.<br />
	In caso la directory di installazione non sia /ocarina2, modificala correttamente nelle righe 9-12, 28-31 e 34 del file <i>.htaccess</i>.<br />
	Subito dopo l\'invio della configurazione, ti verrà presentato un form per registrarti come amministratore, dopodichè ti basterà eliminare questo file (<i>setup.php</i>).
	<p align="right">Buon proseguimento con Ocarina,<br />
	<i>Giovanni `Roxas Shadow` Capuano</i></p><br />
	
	<form action="" method="post">
	<b>Nome del sito</b><br />
	<input type="text" name="nomesito" maxlength="100" /><br /><br />

	<b>Email</b><br />
	<input type="text" name="email" maxlength="100" /><br /><br />

	<b>Permetti registrazioni (0 = No, 1 = Si)</b><br />
	<input type="text" name="registrazioni" maxlength="1" /><br /><br />

	<b>Validazione account con conferma email (0 = No, 1 = Si)</b><br />
	<input type="text" name="validazioneaccount" maxlength="1" /><br /><br />

	<b>Abilita commenti (0 = No, 1 = Si)</b><br />
	<input type="text" name="commenti" maxlength="1" /><br /><br />

	<b>Approva commenti automaticamente (0 = Si, 1 = No)</b><br />
	<input type="text" name="approvacommenti" maxlength="1" /><br /><br />

	<b>Registra log automaticamente (0 = No, 1 = Si) **</b><br />
	<input type="text" name="log" maxlength="1" /><br /><br />
	
	<b>Attiva motore plugin (0 = No, 1 = Si)</b><br />
	<input type="text" name="plugin" maxlength="1" /><br /><br />

	<b>Nome del cookie</b><br />
	<input type="text" name="cookie" maxlength="20" /><br /><br />

	<b>Durata login in secondi (ex.: 3600 = 1 ora, 1296000 = 15 giorni)</b><br />
	<input type="text" name="loginexpire" maxlength="20" /><br /><br />

	<b>Skin di default (a meno che non hai modificato skin, si chiama <<default>> :)</b><br />
	<input type="text" name="skin" maxlength="20" /><br /><br />

	<b>Breve descrizione del sito</b><br />
	<input type="text" name="description" maxlength="151" /><br /><br />

	<b>Limite caratteri news (0=Disattiva anteprima news dalla index)</b><br />
	<input type="text" name="limitenews" maxlength="10" /><br /><br />

	<b>News da mostrare per pagina (nella index)</b><br />
	<input type="text" name="impaginazionenews" maxlength="10" /><br /><br />

	<b>Minuti per i quali un utente è considerato online finchè non compie un\'azione (per un sito senza esigenze specifiche è consigliato dai 5 ai 10)</b><br />
	<input type="text" name="limiteonline" maxlength="10" /><br /><br />

	<b>Permetti di votare news e pagine (0 = No, 1 = Si)</b><br />
	<input type="text" name="permettivoto" maxlength="1" /><br /><br />

	<b>URL (ex.: http://www.tuosito.com)</b><br />
	<input type="text" name="url" maxlength="100" /><br /><br />

	<b>URL index (ex.: http://www.tuosito.com/ocarina2)</b><br />
	<input type="text" name="url_index" maxlength="100" /><br /><br />

	<b>URL admin (ex.: http://www.tuosito.com/ocarina2/admin)</b><br />
	<input type="text" name="url_admin" maxlength="100" /><br /><br />

	<b>URL rendering (ex.: http://www.tuosito.com/ocarina2/rendering)</b><br />
	<input type="text" name="url_rendering" maxlength="100" /><br /><br />

	<b>URL immagini (ex.: http://www.tuosito.com/ocarina2/immagini)</b><br />
	<input type="text" name="url_immagini" maxlength="100" /><br /><br />

	<b>Root (ex.: '.substr($_SERVER['DOCUMENT_ROOT'], 0, -1).')</b><br />
	<input type="text" name="root" maxlength="100" /><br /><br />

	<b>Root index (ex.: '.substr($_SERVER['DOCUMENT_ROOT'], 0, -1).'ocarina2)</b><br />
	<input type="text" name="root_index" maxlength="100" /><br /><br />

	<b>Root admin (ex.: '.substr($_SERVER['DOCUMENT_ROOT'], 0, -1).'ocarina2/admin)</b><br />
	<input type="text" name="root_admin" maxlength="100" /><br /><br />

	<b>Root rendering (ex.: '.substr($_SERVER['DOCUMENT_ROOT'], 0, -1).'ocarina2/rendering)</b><br />
	<input type="text" name="root_rendering" maxlength="100" /><br /><br />

	<b>Root immagini (ex.: '.substr($_SERVER['DOCUMENT_ROOT'], 0, -1).'ocarina2/immagini)</b><br />
	<input type="text" name="root_immagini" maxlength="100" /><br /><br />

	<input type="submit" name="submit" value="Installa" />
	</form>
	<br /><br />
	
	*Il caching consiste nel salvare sottoforma di file le richieste verso il database, in modo che finchè non vi è alcuna modifica, esso non viene più interpellato, poichè i dati saranno prelevati dai suddetti file.<br />
	La convenienza sussiste nel fatto che le prestazioni globali aumenteranno, ma ci saranno uno o più file per ogni pagina, il che potrebbe dare problemi per lo spazio FTP concesso ad Ocarina.<br /><br />
	
	**Attivando i log si aumenta il carico del database, ed è doveroso pulirli tramite l\'apposito bottone nell\'amministrazione spesso, per evitare la saturazione delle risorse destinato ad esso.<br />
	Si consiglia quindi di attivarli solamente se sarà possibile pulirli spesso (in base al numero di visitatori).<br />
	In ogni caso è possibile sempre attivarli o disattivarli dall\'amministrazione per ogni evenienza.

	</body>
	</html>';
