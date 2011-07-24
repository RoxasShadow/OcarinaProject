<?php
/* Permette di scegliere la news il commento da cancellare in cancellacommento.php o modificare in modificacommento.php */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

// Prelevo le news
$query = $db->query("SELECT * FROM news");
$query2 = $db->query("SELECT * FROM news");

// Creo la select con tutte le news
/* Cancella commento */
$text = '<form method="post" action="cancellacommento.php">
<div align="center">
Cancella commento dalla news: <select name="minititolo">';

while ($riga = $db->estrai($query)) {
	$text .= '<option value="'.$func->rescape($riga->minititolo).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="cancellacommento" type="submit" value="Cancella"></form><br /><br />';

/* Modifica commento */
$text .= '<form method="post" action="modificacommento.php">
<div align="center">
Modifica commento dalla news: <select name="minititolo">';

while ($riga2 = $db->estrai($query2)) {
	$text .= '<option value="'.$func->rescape($riga2->minititolo).'">'.$func->rescape($riga2->titolo).'</option>';
}

$text .= '</select>
<input name="modificacommento" type="submit" value="Modifica">';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Modifica commento");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
