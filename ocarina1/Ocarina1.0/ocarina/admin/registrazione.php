<?php
/* Effettua la registrazione */
// Includo le classi principali
include_once "../core/class.MySQL.php";
include_once "../core/class.Ocarina.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";
include_once "../etc/class.Date.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$data = new Date;

// Prima di procedere controllo se l' utente è già loggato
if(($func->logged() == 1) || ($func->logged() == 2)) {
	$text = 'Risulti già loggato, non hai bisogno di registrarti.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Registrazione");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

// Prelevo i dati inseriti nel form e registro l'utente
if(isset($_POST['registrazione'])) {
	$nickname = $func->escape($_POST['nickname']);
	$email = $func->escape($_POST['email']);
	$password = $func->escape($_POST['password']);
	$confpassword = $func->escape($_POST['confpassword']);

	// Confronto e dò l'errore se sono diverse
	if($password !== $confpassword) {
		$text = 'Le password non corrispondono. Riprova.';

		// Visualizzo la pagina
		$smarty->assign("titolo", "Registrazione");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Se il nickname e la password sono minori di 4 caratteri e maggiori di 20 dò errore
	if((strlen($nickname) < 4) OR (strlen($_POST['password']) < 4) OR (strlen($nickname) > 20) OR (strlen($_POST['password']) > 20)) {
		$text = 'Il nickname o la password non rientrano nei requisiti: devono essere composti di almeno 4 caratteri e avere massimo 20 caratteri.';
		// Visualizzo la pagina
		$smarty->assign("titolo", "Registrazione");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Controllo la validità del nickname
	if(!preg_match("/^^[a-zA-Z0-9 ]+$/", $nickname)) {
		$text = 'Il nickname non è valido: sono permessi solo nickname formati da lettere, spazi e numeri.';
		// Visualizzo la pagina
		$smarty->assign("titolo", "Registrazione");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Controllo l'email
	if(!eregi("^[a-z0-9][_\.a-z0-9-]+@([a-z0-9][0-9a-z-]+\.)+([a-z]{2,4})", $email)) {
		$text = 'L\'indirizzo email non è valido.';
		// Visualizzo la pagina
		$smarty->assign("titolo", "Registrazione");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Controllo se l'email o il nickname sono doppi
	$db->connettidb(); // Mi connetto al database
	$query = $db->query("SELECT nickname FROM utenti WHERE nickname='$nickname'");
	$query2 = $db->query("SELECT email FROM utenti WHERE email='$email'");
	$conta = $db->conta($query);
	$conta2 = $db->conta($query2);
	$db->disconnettidb(); // Mi disconnetto dal database

	if(($conta > 0) OR ($conta2 > 0)) {
		$text = 'Il nickname o l\'indirizzo email da te scelto è già in uso. Riprova scegliendone un altro.';
		$smarty->assign("titolo", "Registrazione");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Registro l'utente
	$password = $func->hash($password); // Converto la password nell'algoritmo di hash
	$dataregistrazione = $data->data("-");
	$db->connettidb(); // Mi connetto al database
	$db->query("INSERT INTO utenti(nickname,password,email,dataregistrazione) VALUES('$nickname','$password','$email','$dataregistrazione')");
	$db->disconnettidb(); // Mi disconnetto dal database
	$text = 'Registrazione effettuata.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Registrazione");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

// Visualizzo il form di registrazione
$text = '<form method="post" action="">
Nickname:<br />
<input name="nickname" type="text"><br /><br />
Password:<br />
<input name="password" type="password"><br /><br />
Conferma password:<br />
<input name="confpassword" type="password"><br /><br />
Email:<br />
<input name="email" type="text"><br /><br />
<input name="registrazione" type="submit" value="Registrati">
</form>';
$smarty->assign("titolo", "Registrazione");
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
