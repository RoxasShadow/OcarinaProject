<?php
error_reporting(0);
/* La pagina principale */
// Includo le classi principali
include_once "../core/class.Ocarina.php";
include_once "../core/class.MySQL.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$codice = $_COOKIE[$func->cookie()];

$text = 'Ciao '.$db->nickname($codice).', benvenuto in Ocarina - '.$cms->cmsversion().'!';
$smarty->assign("titolo", "Principale");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
