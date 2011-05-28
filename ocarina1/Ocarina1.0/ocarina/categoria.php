<?php
error_reporting(0);
/* Data una categoria, dà una lista di tutte le news e sezioni associate */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";
include_once "etc/function.Ricercaarray.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Mi connetto al database
$db->connettidb();

// Scarico le categorie
$categoria = $func->escape($_GET['categoria']);

$query = $db->query("SHOW COLUMNS FROM news LIKE 'categoria'");
$righe = $db->conta($query);
$query2 = $db->query("SHOW COLUMNS FROM pagine LIKE 'categoria'");
$righe2 = $db->conta($query);

for ($i=0; $i<$righe; $i++) {
	$row = mysql_fetch_row($query);
	$options = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
}

for ($i=0; $i<$righe2; $i++) {
	$row2 = mysql_fetch_row($query2);
	$options2 = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row2[1]));
}

// Cerco nell' array
$cerca = ricercaarray($options, $categoria);

// Cerco nell' array
$cerca2 = ricercaarray($options2, $categoria2);

// Se la categoria non esiste diamo l'errore
if(($cerca <= 0) OR ($cerca2 <= 0)) {
	$errore = 'Categoria non trovata';
	$smarty->assign("titolo", 'Categoria non trovata &raquo; '.$cms->nomesito()); // Titolo della pagina
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
	$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
	$smarty->display($cms->skin()."/index/404.tpl"); // La pagina degli errori
	$db->disconnettidb(); // Posso disconnettermi dal database
	exit;
}

$query3 = $db->query("SELECT titolo, minititolo FROM news WHERE categoria = '$categoria'");
$query4 = $db->query("SELECT titolo, minititolo FROM pagine WHERE categoria = '$categoria'");

// Se ci sono news nella categoria le stampa
$conta = $db->conta($query3);

// Se ci sono sezioni nella categoria le stampa
$conta2 = $db->conta($query4);

if($conta > 0) {
	while($riga = $db->estrai($query3)) {
		$minititolo = $func->rescape($riga->minititolo);
		$titolo = $func->rescape($riga->titolo);
		$categorie .= '<a href="'.$cms->url_index().'news.php?titolo='.$minititolo.'">'.$titolo.'</a><br />';
	}
}

if($conta2 > 0) {
	while($riga = $db->estrai($query4)) {
		$minititolo = $func->rescape($riga->minititolo);
		$titolo = $func->rescape($riga->titolo);
		$categorie .= '<a href="'.$cms->url_index().'sezioni.php?titolo='.$minititolo.'">'.$titolo.'</a><br />';
	}
}

// Visualizzo la pagina
$smarty->assign("titolo", 'Categoria: '.$categoria.' &raquo; '.$cms->nomesito()); // Titolo della pagina
$smarty->assign("navigatore", $navigatore); // Il navigatore per avanzare con le pagine delle news
$smarty->assign("categorie", $categorie); // L'array contenente le news
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
$smarty->display($cms->skin()."/categorie/categorie.tpl");
$db->disconnettidb(); // Posso disconnettermi dal database
?>
