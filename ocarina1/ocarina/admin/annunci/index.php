<?php
/* Visualizza gli annunci */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";
include_once "../../etc/function.BBCode.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$query = $db->query("SELECT * FROM annunci");
while ($riga = $db->estrai($query)) {
	$autore = $func->rescape($riga->autore);
	$titolo = $func->rescape($riga->titolo);
	$annuncio = bbcode($func->rescape($riga->annuncio));
	$data = $func->rescape($riga->data);
	$ora = $func->rescape($riga->ora);
	$text .= '<fieldset><legend><i>'.$titolo.'</i> - Creato da <a href="'.$cms->url_cms().'profilo.php?nickname='.$autore.'">'.$autore.'</a> il '.$data.' alle '.$ora.'. </legend>'.$annuncio.'</fieldset><br />';
}

$smarty->assign("titolo", "Annunci");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
