<?php
error_reporting(0);
/* La index, dove si visualizzano le news */
// Includo le classi principali
include_once "core/class.Ocarina.php";
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "rendering/config.php";
include_once "etc/class.Impaginazione.php";
include_once "etc/function.BBCode.php";
include_once "etc/class.Date.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$data = new Date;

// Mi connetto al database
$db->connettidb();

// Impaginazione
$p = new Paging;
$max = 7; // Articoli per pagina
$inizio = $p->paginaIniziale($max);
$query = $db->query("SELECT * FROM news");
$conta = $db->conta($query); // Conto le news

// Se ci sono le news proseguo a stamparle
if($conta > 0) {
	$pagine = $p->contaPagine($count, $max);

	// Nell' array $results ci andrà tutto ciò che riguarda le news
	$result = array();
	$query2 = $db->query("SELECT * FROM news ORDER BY id DESC LIMIT ".$inizio.",".$max);
	$data = $data->data("-");
	$data2 = explode("-", $data);

	// Date
	while($r = mysql_fetch_array($query2)){
		if($r["data"] == $data) {
			$r["data"] = 'oggi';
		}
		elseif($r["data"] == $data2[0] -1) {
			$r["data"] = 'ieri';
		}
		elseif($r["data"] == $data2[0] -2) {
			$r["data"] = 'l\' altro ieri';
		}
		else {
			$r["data"] = 'il giorno '.$r["data"];
		}

		$results[] = array(
		"autore"=> $func->rescape($r["autore"]), // L'autore
		"titolo"=> $func->rescape($r["titolo"]), // Il titolo
		"minititolo"=> $func->rescape($r["minititolo"]), // Il minititolo
		"keyword"=> $func->rescape($r["keyword"]), // La keyword
		"categoria"=> $func->rescape($r["categoria"]), // La categoria
		"data"=> $func->rescape($r["data"]), // La data
		"ora"=> $func->rescape($r["ora"]), // L'ora
		"autorelink"=> '<a href="'.$cms->url_cms().'profilo.php?nickname='.$r["autore"].'">'.$r["autore"].'</a>', // Il profilo dell'autore
		"categorialink"=> '<a href="'.$cms->url_index().'categoria.php?cat='.$r["categoria"].'">'.$r["categoria"].'</a>.', // Il link alla categoria
		"linktitolo"=> '<a href="'.$cms->url_index().'news.php?titolo='.$r["minititolo"].'">'.$r["titolo"].'</a>', // Il titolo con il link ai commenti
		"scrivinews"=> bbcode($r["news"]).'<br />', // La news
		"commenti"=> '<a href="'.$cms->url_index().'news.php?titolo='.$r["minititolo"].'">Lascia un commento</a>', // Il link ai commenti
		);
		$navigatore = $p->precedenteSuccessiva($_GET['p'], $pagine);
	}

	// Visualizzo la pagina
	$smarty->assign("titolo", $cms->nomesito()); // Titolo della pagina
	$smarty->assign("navigatore", $navigatore); // Il navigatore per avanzare con le pagine delle news
	$smarty->assign("scrivinews", $results); // L'array contenente le news
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
	$smarty->display($cms->skin()."/index/index.tpl");
	$db->disconnettidb(); // Posso disconnettermi dal database
	exit;
}

// Se non ci sono news avviso
else {
	$errore = 'Non è ancora presente nessuna news.';
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
	$smarty->assign("url_templates", $cms->url_smartytpl()); // Url templates
	$smarty->display($cms->skin()."/index/404.tpl"); // La pagina degli errori
	$db->disconnettidb(); // Posso disconnettermi dal database
}
?>
