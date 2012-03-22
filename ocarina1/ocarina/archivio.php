<?php
error_reporting(0);
/* Dà una lista di tutte le news e sezioni presenti */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Mi connetto al database
$db->connettidb();

// Effetto le query
$query = $db->query("SELECT DISTINCT titolo,minititolo FROM pagine");
$query2 = $db->query("SELECT DISTINCT titolo,minititolo FROM news");

// Stampo le sezioni
while($righe = $db->estrai($query)) {
	$sezioni .= '&raquo;  <a href="'.$cms->url_index().'sezioni.php?titolo='.$func->rescape($righe->minititolo).'">'.$func->rescape($righe->titolo).'</a><br />';
}

// Stampo le news
while($righe2 = $db->estrai($query2)) {
	$news .= '&raquo;  <a href="'.$cms->url_index().'news.php?titolo='.$func->rescape($righe2->minititolo).'">'.$func->rescape($righe2->titolo).'</a><br />';
}

// Visualizzo la pagina
$smarty->assign("titolo", "Archivio &raquo; ".$cms->nomesito()); // Titolo della pagina
$smarty->assign("sezioni", $sezioni); // Le sezioni
$smarty->assign("news", $news); // Le news
$smarty->assign("description", $cms->description()); // La descrizione
$smarty->assign("keywords", $cms->keywords()); // Le keywords
$smarty->assign("numsezioni", $db->numsezioni()); // Numero sezioni
$smarty->assign("numnews", $db->numnews()); // Numero news
$smarty->assign("numutenti", $db->numutenti()); // Numero utenti
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()])); // Cookie
$smarty->assign("nickname", $db->nickname($_COOKIE[$func->cookie()])); // Nickname
$smarty->assign("email", $db->email($_COOKIE[$func->cookie()])); // Email
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()])); // Grado
$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
$smarty->display($cms->skin()."/archivio/archivio.tpl");
$db->disconnettidb(); // Mi disconnetto dal database
?>
