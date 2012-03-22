<?php
/* Effettua il logout */
// Includo le classi principali
include_once "../core/class.MySQL.php";
include_once "../core/class.Ocarina.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Prima di procedere controllo se l' utente è già loggato
if($func->logged() == 0) {
	$text = 'Non risulti loggato, non hai bisogno di effettuare il logout.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Logout");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

// Prelevo il codice dal cookie
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

// Elimino il codice dal database
$query = $db->query("UPDATE utenti SET codice='' WHERE codice='$codice'");

// Mi disconnetto dal database
$db->disconnettidb();

// Effettuo il logout distruggendo il cookie
setcookie($func->cookie(), '', time()-1, "/");

// Dirigo l' utente verso la index
header("Location: index.php");
exit;
?>
