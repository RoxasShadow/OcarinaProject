<?php
/* Permette di scegliere la sezione da modificare poi in editasezione.php */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";
include_once "../../etc/class.Date.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

// Prelevo le sezioni
$query = $db->query("SELECT DISTINCT * FROM pagine");

// Creo la select con tutte le sezioni
$text = '<form method="post" action="editasezione.php">
<div align="center">
<select name="minititolo">';

while ($riga = $db->estrai($query)) {
	$text .= '<option value="'.$func->rescape($riga->minititolo).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="editaquestasezione" type="submit" value="Modifica"></form>';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Modifica sezione");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
