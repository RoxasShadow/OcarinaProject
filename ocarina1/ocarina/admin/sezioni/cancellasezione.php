<?php
/* Permette cancellare una sezione */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

/* La cancellazione della sezione */
if(isset($_POST['cancellasezione'])) {
	// Racchiudo il minititolo nella variabile
	$minititolo = $func->escape($_POST['minititolo']);

	// Mi connetto al database
	$db->connettidb();

	// Cancello la sezione
	$db->query("DELETE FROM pagine WHERE minititolo='$minititolo'");

	// Mi disconnetto dal database
	$db->disconnettidb();

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$codice = $_COOKIE[$func->cookie()];
		$azione = 'cancellato una sezione ('.$minititolo.')';
		$db->log($codice, $azione);
	}

	$text = 'La sezione è stata cancellata.';
	$smarty->assign("titolo", "Cancella sezione");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}


// Mi connetto al database
$db->connettidb();

// Prelevo le sezione
$query2 = $db->query("SELECT minititolo,titolo FROM pagine");

// Creo la select con tutte le sezioni
$text = '<form method="post" action="">
<div align="center">
<select name="minititolo">';

while ($riga = $db->estrai($query2)) {
	$text .= '<option value="'.$func->rescape($riga->minititolo).'">'.$func->rescape($riga->titolo).'</option>';
}

$text .= '</select>
<input name="cancellasezione" type="submit" value="Cancella">';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Cancella sezione");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
