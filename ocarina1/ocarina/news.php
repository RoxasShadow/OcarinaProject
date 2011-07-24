<?php
error_reporting(0);
/* Visualizza una news, e permette di guardare e inviare commenti */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";
include_once "etc/function.BBCode.php";
include_once "etc/class.Date.php";
include_once "etc/class.Autokeyword.php";
include_once "etc/function.Autodescription.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$datatime = new Date;

// Mi connetto al database
$db->connettidb();

// Scarico la news
$titolo_get = $func->escape($_GET['titolo']);

$query = $db->query("SELECT * FROM news WHERE minititolo='$titolo_get'");
$righe = $db->conta($query);

// Se la news esiste la prelevo
if($righe > 0) {
	while($riga = $db->estrai($query)) {
		$autore = $func->rescape($riga->autore);
		$titolo = $func->rescape($riga->titolo);
		$minititolo = $func->rescape($riga->minititolo);
		$news = bbcode($func->rescape($riga->news));
		$categoria = $func->rescape($riga->categoria);
		$data = $func->rescape($riga->data);
		$ora = $func->rescape($riga->ora);
	}

	$data_attuale = $datatime->data("-");
	$data_attuale2 = explode("-", $data_attuale);

	// Date
	if($data == $data_attuale) {
		$data = 'oggi';
	}
	elseif($r["data"] == $data_attuale2[0] -1) {
		$data = 'ieri';
	}
	elseif($r["data"] == $data_attuale2[0] -2) {
		$data = 'l\' altro ieri';
	}
	else {
		$data = 'il giorno '.$data;
	}

	$autorelink = '<a href="'.$cms->url_cms().'profilo.php?nickname='.$autore.'">'.$autore.'</a>';
	$categorialink = '<a href="'.$cms->url_index().'categoria.php?cat='.$categoria.'">'.$categoria.'</a>';
	$description = autodescription($news, 120); // Descrizione di 120 caratteri
	$setkeyword['content'] = $news; // Testo
	$setkeyword['min_word_length'] = 5; // Caratteri minimi singola keyword
	$setkeyword['min_word_occur'] = 2; // Presenza delle parole nel testo perchè diventino keyword
	$setkeyword = new autokeyword($setkeyword, "iso-8859-1");
	$keyword = $setkeyword->parse_words();

	// I commenti
	$query2 = $db->query("SELECT * FROM commenti WHERE titolo='$titolo_get' ORDER BY data,ora ASC");
	$commenti = array();
	while($riga2 = $db->estrai($query2)){
		$commenti[] = array(
		"data_com"=> $func->rescape($riga2->data),
		"ora_com"=> $func->rescape($riga2->ora),
		"autore_com_link"=> '<a href="'.$cms->url_cms().'profilo.php?nickname='.$riga2->autore.'">'.$riga2->autore.'</a>',
		"commento_bbcode"=> bbcodecommenti($func->rescape($riga2->testo)),
		"ora_com"=> $func->rescape($riga2->ora),
		);
	}

	// Visualizzo la pagina
	$smarty->assign("titolo", $titolo.' &raquo; '.$cms->nomesito()); // Titolo della pagina
	$smarty->assign("autorelink", $autorelink); // Il link al profilo dell'autore
	$smarty->assign("categorialink", $categorialink); // Il link alla categoria
	$smarty->assign("titolonews", $titolo); // Il titolo della news
	$smarty->assign("data", $data); // La data
	$smarty->assign("ora", $ora); // L'ora
	$smarty->assign("numcommenti", $numcommenti); // Il numero dei commenti
	$smarty->assign("scrivinews", $news); // La news
	$smarty->assign("commenti", $commenti); // L'array con i commenti
	$smarty->assign("description", $description); // La descrizione
	$smarty->assign("keywords", $keyword); // Le keywords
	$smarty->assign("numsezioni", $db->numsezioni()); // Numero sezioni
	$smarty->assign("numnews", $db->numnews()); // Numero news
	$smarty->assign("numutenti", $db->numutenti()); // Numero utenti
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()])); // Cookie
	$smarty->assign("nickname", $db->nickname($_COOKIE[$func->cookie()])); // Nickname
	$smarty->assign("email", $db->email($_COOKIE[$func->cookie()])); // Email
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()])); // Grado
	$smarty->assign("textarea", $func->textareabbcodecommenti()); // La textarea per i commenti
	$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
	$smarty->display($cms->skin()."/news/news.tpl");
	$db->disconnettidb(); // Posso disconnettermi dal database
	exit;
}
else {
	// Se non ci sono news avvisa
	$errore = 'Non è stata trovata nessuna news.';
	$smarty->assign("titolo", $cms->nomesito()); // Titolo della pagina
	$smarty->assign("errore", $errore); // L'error
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
	$smarty->display($cms->skin()."/index/404.tpl"); // La pagina degli errori
	$db->disconnettidb(); // Posso disconnettermi dal database
}
?>
