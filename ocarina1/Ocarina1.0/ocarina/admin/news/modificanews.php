<?php
/* Permette di scegliere la news da modificare poi in editanews.php */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poich� i processi di prima finivano con un exit, se siamo qui � solo perch� siamo loggati
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

// Prelevo le news
$query = $db->query("SELECT * FROM news ORDER BY id DESC");

// Creo la select con tutte le news
$text = '<form method="post" action="editanews.php">
<div align="center">
<select name="minititolo">';

while ($riga = $db->estrai($query)) {
	$text .= '<option value="'.$func->rescape($riga->minititolo).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="editaquestanews" type="submit" value="Modifica"></form>';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Modifica news");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
