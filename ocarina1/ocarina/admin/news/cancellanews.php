<?php
/* Permette di cancellare una news */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

/* La cancellazione della news */
if(isset($_POST['cancellanews'])) {
	// Racchiudo l' id nella variabile
	$minititolo = $func->escape($_POST['minititolo']);

	// Mi connetto al database
	$db->connettidb();

	// Cancello i commenti relativi alla news
	$db->query("DELETE FROM commenti WHERE titolo='$minititolo'");

	// Cancello la news
	$db->query("DELETE FROM news WHERE minititolo='$minititolo'");

	// Mi disconnetto dal database
	$db->disconnettidb();

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$azione = 'cancellato una news ('.$minititolo.')';
		$db->log($codice, $azione);
	}

	$text = 'La news è stata cancellata.';
	$smarty->assign("titolo", "Cancella news");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}

// Mi connetto al database
$db->connettidb();

// Prelevo le news
$query2 = $db->query("SELECT * FROM news ORDER BY id DESC");

// Creo la select con tutte le news
$text = '<form method="post" action="">
<div align="center">
<select name="minititolo">';

while ($riga = $db->estrai($query2)) {
	$text .= '<option value="'.$func->rescape($riga->minititolo).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="cancellanews" type="submit" value="Cancella">';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Cancella news");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
