<?php
error_reporting(0);
/* Invia il commento */
// Includo le classi principali
include_once "core/class.MySQL.php";
include_once "core/class.Functions.php";
include_once "etc/class.Date.php";

// Istanzio le classi
$db = new MySQL;
$func = new Functions;
$date = new Date;

// La pagina da dove sono venuto
$ref = $_SERVER['HTTP_REFERER'];

// Ottengo il titolo della news dal GET
$titolo_com = explode("=", $ref); 
$titolo_com = $titolo_com[1];

if(isset($_POST['commenta'])){
	// Prelevo i dati
	$titolo_com = $func->escape($titolo_com);
	$data_com = $func->escape($date->data("-"));
	$ora_com = $func->escape($date->ore_min_sec(":"));
	$testo_com = $func->escape($_POST['testo_com']);
	
	// Prelevo il nickname dal database
	$codice = $_COOKIE[$func->cookie()];
	$autore_com = $db->nickname($codice);
	
	// Se almeno un campo è vuoto rimando alla pagina precedente, altrimenti effetto la query e rimando nella pagina precedente.
	if(($titolo_com == '') OR ($autore_com == '') OR ($testo_com == '')) {
	header("Location: $ref");
	exit;
	}
	else {
	$db->connettidb();
	$db->query("INSERT INTO commenti (titolo,data,ora,autore,testo) VALUES ('$titolo_com', '$data_com', '$ora_com', '$autore_com', '$testo_com')");
	$db->disconnettidb();
	header("Location: $ref");
	exit;
	}
}
?>
