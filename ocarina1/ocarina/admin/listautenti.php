<?php
/* Visualizza la lista degli utenti */
// Includo le classi principali
include_once "../core/class.Ocarina.php";
include_once "../core/class.MySQL.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

/* START */

// Mi connetto al database
$db->connettidb();

// Effettuo la query per prelevare i dati
$query = $db->query("SELECT nickname FROM utenti");

// Preparo la tabella
$text = '<div align="center"><h2>Lista utenti</h2><br />';
$text .= '<table align="center" border="0">
<tr>
<td><b>Nickname</b></td>
<td><b>Profilo</b></td>
</tr>';

while($riga = $db->estrai($query)) {
	$nickname = $func->rescape($riga->nickname);
	$text .= '
<tr>
<td>'.$nickname.'</td>
<td><a href="profilo.php?nickname='.$nickname.'">Accedi</a></td>
</tr>';
}

$text .= '</table>';

// Mi disconnetto dal database
$db->disconnettidb();

// Controllo se l'utente è loggato o meno per configurare il menù
if(($func->logged() == 1) || ($func->logged() == 2)) {
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
}
$smarty->assign("titolo", $profilo);
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
