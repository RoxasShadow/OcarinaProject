<?php
/* Crea gli annunci */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";
include_once "../../etc/class.Date.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$data = new Date;

/* L' invio dell'annuncio */

if(isset($_POST['creaannuncio'])) {
	// Creo le variabili con i dati
	$codice = $_COOKIE[$func->cookie()];
	$autore = $db->nickname($codice);
	$titolo = $func->escape($_POST['titolo']);
	$annuncio = $func->authescape($_POST['annuncio']);
	$ora = $data->ore_min(':');
	$data = $data->data('-');

	// Controllo se nel database non ci sia una news con un titolo uguale
	$db->connettidb();
	$query = $db->query("SELECT titolo FROM annunci WHERE titolo = '$titolo'");
	$conta = $db->conta($query);

	// Se esiste avviso e blocco lo script
	if($conta > 0) {
		$text = 'Esiste già un\' annuncio con lo stesso titolo che hai scelto. Prova a modificarlo e riprova.';
		$smarty->assign("titolo", "Crea annuncio");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index.tpl");
		exit;
	}

	// Altrimenti invio la news al database
	$query2 = $db->query("INSERT INTO annunci (autore, titolo, annuncio, data, ora) VALUES ('$autore', '$titolo', '$annuncio', '$data', '$ora')");

	// Mi disconnessione dal database
	$db->disconnettidb();

	// Mando l' avviso
	$text = 'L\' annuncio è stato creato.';
	$smarty->assign("titolo", "Crea annuncio");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati

$text = 'Creando un annuncio potrai pubblicarlo nell\'area dedicata di Ocarina così che sia alla vista di tutti coloro che hanno il permesso di accederci.<br /><br />
<form method="post" action="">
Titolo:<br /><input name="titolo" type="text" size="30"><br />
Annuncio:<br />'.$func->textareabbcode('annuncio','').'<br /><input name="creaannuncio" type="submit" value="Invia"></form>';

$smarty->assign("titolo", "Crea annuncio");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
