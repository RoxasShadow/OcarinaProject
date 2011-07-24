<?php
error_reporting(0);
/* La pagina di ricerca */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Se si richiede la ricerca esegue
if((isset($_POST['keyword'])) && $_POST['keyword'] !== '') {

	// Prelevo la keyword
	$keyword = $func->escape($_POST['keyword']);

	// Mi connetto al database
	$db->connettidb();

	// Effetto le query
	$query = $db->query("SELECT DISTINCT titolo,minititolo FROM pagine WHERE titolo LIKE '%".$keyword."%' OR contenuto LIKE '%".$keyword."%';");
	$query2 = $db->query("SELECT DISTINCT titolo,minititolo FROM news WHERE titolo LIKE '%".$keyword."%' OR news LIKE '%".$keyword."%';");
	$conta = $db->conta($query);
	$conta2 = $db->conta($query2);

	// Se non ci sono risultati
	if(($conta <= 0) AND ($conta2 <= 0)) {
		$errore = 'Nessun risultato per la keyword immessa.';

		// Visualizzo la pagina di errore
		$smarty->assign("titolo", "Nessun risultato per la keyword immessa &raquo; ".$cms->nomesito()); // Titolo della pagina
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
		exit;
	}

	// Altrimenti stampo i risultati
	while($righe = $db->estrai($query)) {
		$risultati .= '&raquo;  <a href="'.$cms->url_index().'sezioni.php?titolo='.$func->rescape($righe->minititolo).'">'.$func->rescape($righe->titolo).'</a><br />';
	}

	while($righe2 = $db->estrai($query2)) {
		$risultati .= '&raquo;  <a href="'.$cms->url_index().'news.php?titolo='.$func->rescape($righe2->minititolo).'">'.$func->rescape($righe2->titolo).'</a><br />';
	}

	// Visualizzo la pagina
	$smarty->assign("titolo", "Risultati ricerca &raquo; ".$cms->nomesito()); // Titolo della pagina
	$smarty->assign("risultati", $risultati); // I risultati della ricerca
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
	$smarty->display($cms->skin()."/ricerca/risultati.tpl");
	$db->disconnettidb(); // Mi disconnetto dal database
	exit;
}

// Visualizzo la pagina
$smarty->assign("titolo", "Cerca nel sito &raquo; ".$cms->nomesito()); // Titolo della pagina
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
$smarty->display($cms->skin()."/ricerca/risultati.tpl");
?>
