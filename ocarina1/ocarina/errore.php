<?php
error_reporting(0);
/* La pagina di errore generale */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

$errore = 'Se stai cercando una news oppure una sezione, aiutati con il <a href="'.$cms->url_index().'ricerca.php">motore di ricerca integrato</a>.<br />
Se riscontri comportamenti anomali da parte del sito, contatta il webmaster.';

// Visualizzo la pagina
$smarty->assign("titolo", "La pagina non è stata trovata &raquo; ".$cms->nomesito()); // Titolo della pagina
$smarty->assign("errore", $errore); // Il contenuto della pagina
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
$smarty->display($cms->skin()."/index/404.tpl");
?>
