<?php
/* Permette di modificare il commento della news proveniente da moderacommento.php */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Se non arriva il minititolo da modificanews.php dai un errore e ferma tutto
if((!isset($_POST['modificacommento'])) && (!isset($_POST['modificaid']))) {
	$text = 'Questa pagina � richiamabile solo da <a href="'.$cms->url_cms().'moderacommento.php">Modera commento</a>.';
	$smarty->assign("titolo", "Modifica commento");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}

/* La modifica della news */
if((isset($_POST['modificaid'])) && (isset($_POST['newcommento']))) {
	// Racchiudo l'id e il commento nelle variabili
	$id = $func->escape($_POST['id']);
	$newcommento = $func->escape($_POST['newcommento']);

	// Mi connetto al database
	$db->connettidb();

	// Modifico la news
	$db->query("UPDATE commenti SET testo='$newcommento' WHERE id='$id'");

	// Mi disconnetto dal database
	$db->disconnettidb();

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$codice = $_COOKIE[$func->cookie()];
		$azione = 'modificato un commento ('.$id.')';
		$db->log($codice, $azione);
	}

	$text = 'Il commento � stato modificato.';
	$smarty->assign("titolo", "Modifica commento");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}



// Racchiudo il minititolo nella variabile
$minititolo = $func->escape($_POST['minititolo']);

// Mi connetto al database
$db->connettidb();

// Creo le query per estrarre i commenti
$query = $db->query("SELECT * FROM commenti WHERE titolo='$minititolo'");
$query2 = $db->query("SELECT * FROM commenti WHERE titolo='$minititolo'");
$query3 = $db->query("SELECT * FROM commenti WHERE titolo='$minititolo'");

// Creo una tabella con i commenti e gli id
$text = '<div align="center"><table border="1">
<tr>
<td><b>Id</b></td>
<td><b>Autore</b></td>
<td><b>Commento</b></td>';

while (($riga = $db->estrai($query)) && ($riga2 = $db->estrai($query2)) && ($riga3 = $db->estrai($query3))) {
	$text .= '<tr>';
	$text .= '<td>'.$func->rescape($riga->id).'</td>';
	$text .= '<td>'.$func->rescape($riga2->autore).'</td>';
	$text .= '<td>'.$func->rescape($riga2->testo).'</td>';
	$text .= '</tr>';
}

$text .= '</table></div><br /><br />';

// Mi disconnetto dal database
$db->disconnettidb();

// Creo il form dove cancellare il commento dando l' id
$text .= '<form method="post" action="">
Scrivi l\'id relativo alla news che vuoi modificare<br /><input name="id" type="text"><br />
Nuovo commento<br /> '.$func->textareabbcode('newcommento', '').'<br />
<input name="modificaid" type="submit" value="Modifica">
</form>';

$smarty->assign("titolo", "Modifica commento");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
