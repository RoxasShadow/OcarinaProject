<?php
error_reporting(0);
/* Visualizza una sezione */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";
include_once "etc/function.BBCode.php";
include_once "etc/class.Autokeyword.php";
include_once "etc/function.Autodescription.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Mi connetto al database
$db->connettidb();

// Scarico la sezione
$titolo_get = $func->escape($_GET['titolo']);

$query = $db->query("SELECT * FROM pagine WHERE minititolo='$titolo_get'");
$righe = $db->conta($query);

// Se la sezione esiste la prelevo
if($righe > 0) {
	while($riga = $db->estrai($query)) {
		$titolo = $func->rescape($riga->titolo);
		$contenuto = bbcode($func->rescape($riga->contenuto));
	}

	$description = autodescription($contenuto, 120); // Descrizione di 120 caratteri
	$setkeyword['content'] = $contenuto; // Testo
	$setkeyword['min_word_length'] = 5; // Caratteri minimi singola keyword
	$setkeyword['min_word_occur'] = 2; // Presenza delle parole nel testo perchè diventino keyword
	$setkeyword = new autokeyword($setkeyword, "iso-8859-1");
	$keyword = $setkeyword->parse_words();

	// Visualizzo la pagina
	$smarty->assign("titolo", $titolo.' &raquo; '.$cms->nomesito()); // Titolo della pagina
	$smarty->assign("contenuto", $contenuto); // Il contenuto della sezione
	$smarty->assign("description", $description); // La descrizione
	$smarty->assign("keywords", $keyword); // Le keywords
	$smarty->assign("numsezioni", $db->numsezioni()); // Numero sezioni
	$smarty->assign("numnews", $db->numnews()); // Numero news
	$smarty->assign("numutenti", $db->numutenti()); // Numero utenti
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()])); // Cookie
	$smarty->assign("nickname", $db->nickname($_COOKIE[$func->cookie()])); // Nickname
	$smarty->assign("email", $db->email($_COOKIE[$func->cookie()])); // Email
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()])); // Grado
	$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
	$smarty->display($cms->skin()."/sezioni/sezioni.tpl");
	$db->disconnettidb(); // Posso disconnettermi dal database
	exit;
}
else {
	// Se non ci sono sezioni avvisa
	$errore = 'Non è stata trovata nessuna sezione.';
	$smarty->assign("titolo", $cms->nomesito()); // Titolo della pagina
	$smarty->assign("errore", $errore); // L'errore
	$smarty->assign("description", $cms->description()); // La descrizione
	$smarty->assign("keywords", $cms->keywords()); // Le keywords
	$smarty->assign("numsezioni", $db->numsezioni()); // Numero sezioni
	$smarty->assign("numnews", $db->numnews()); // Numero news
	$smarty->assign("numutenti", $db->numutenti()); // Numero utenti
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()])); // Cookie
	$smarty->assign("nickname", $db->nickname($_COOKIE[$func->cookie()])); // Nickname
	$smarty->assign("email", $db->email($_COOKIE[$func->cookie()])); // Email
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()])); // Grado
	$smarty->display($cms->skin()."/index/404.tpl"); // La pagina degli errori
	$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
	$db->disconnettidb(); // Posso disconnettermi dal database
}
?>
