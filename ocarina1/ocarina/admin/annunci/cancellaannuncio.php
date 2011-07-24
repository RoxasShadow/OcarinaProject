<?php
/* Cancella gli annunci */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

if(isset($_POST['cancellaannuncio'])) {
	// Creo le variabili con i dati
	$codice = $_COOKIE[$func->cookie()];
	$id = $func->escape($_POST['id']);

	// Cancello l'annuncio
	$db->connettidb();
	$query = $db->query("DELETE FROM annunci WHERE id='$id'");

	// Mi disconnessione dal database
	$db->disconnettidb();

	// Mando l' avviso
	$text = 'L\' annuncio è stato cancellato.';
	$smarty->assign("titolo", "Cancella annuncio");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati

// Mi connetto al database
$db->connettidb();

// Prelevo gli annunci
$query2 = $db->query("SELECT * FROM annunci");

$text = '<form method="post" action="">
<div align="center">
<select name="id">';

while ($riga = $db->estrai($query2)) {
	$text .= '<option value="'.$func->rescape($riga->id).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="cancellaannuncio" type="submit" value="Cancella">';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Cancella annuncio");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
