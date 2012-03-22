<?php
/* Permette di modificare la propria password */
// Includo le classi principali
include_once "../core/class.MySQL.php";
include_once "../core/class.Ocarina.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";
include_once "../etc/function.RNG.php";
include_once "../etc/class.Email.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$email = new Emailer;

// Prima di procedere controllo se l' utente è già loggato
if($func->logged() == 0) {
	$text = 'Non risulti loggato. Devi prima effettuare il login per modificare la password.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Modifica password");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

if(isset($_POST['modificapassword'])) {
	$password = $func->hash($func->escape($_POST['password']));
	$nuovapassword = $func->hash($func->escape($_POST['nuovapassword']));
	$confnuovapassword = $func->hash($func->escape($_POST['confnuovapassword']));
	$nickname = $db->nickname($_COOKIE[$func->cookie()]);

	// Confronto i dati con il database
	$db->connettidb(); // Mi connetto al database
	$query = $db->query("SELECT password FROM utenti WHERE nickname='$nickname' AND password='$password'");
	$conta = $db->conta($query);
	$db->disconnettidb(); // Mi disconnetto dal database

	// Verifico se i dati sono corretti per poi dare un errore
	if($conta <= 0) {
		$text = 'La password inserita non corrisponde a quella associata al tuo account. Se hai dimenticato la password, <a href="recuperapassword.php">recuperala</a>.';
		$smarty->assign("titolo", "Modifica password");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Verifico se le nuove password inserite corrispondono
	if($nuovapassword !== $confnuovapassword) {
		$text = 'La nuova password da te inserita non corrisponde con quella di verifica.';
		$smarty->assign("titolo", "Modifica password");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Modifico la password
	$db->connettidb(); // Mi connetto al database
	$query = $db->query("UPDATE utenti SET password='$nuovapassword' WHERE nickname='$nickname' AND password='$password'");
	$db->disconnettidb(); // Mi disconnetto dal database

	// Visualizzo la pagina
	$text = 'La password è stata modificata.';
	$smarty->assign("titolo", "Modifica password");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

// Visualizzo il form di recupero
$text = 'Tramite questo form puoi modificare la tua password attuale.<br /><br />
<form action="" method="post">
 Password attuale<br />
 <input name="password" type="password" value="" /><br /><br />
 Nuova password<br />
 <input name="nuovapassword" type="password" value="" /><br /><br />
 Conferma nuova password<br />
 <input name="confnuovapassword" type="password" value="" /><br />
 <input name="modificapassword" type="submit" value="Modifica password" /><br />
</form>';
$smarty->assign("titolo", "Modifica password");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
