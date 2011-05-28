<?php
/* Visualizza gli ultimi commenti alle news */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

// Prelevo gli ultimi 20 commenti
$query = $db->query("SELECT autore,titolo,data FROM commenti ORDER BY id DESC LIMIT 20");

// Creo la tabella
$text = '<table align="center" border="1">
<tr>
<td>Autore</td>
<td>News</td>
<td>Data</td>
</tr>';

// Visualizzo i commenti
while($riga = $db->estrai($query)) {
	$autore = $riga->autore;
	$titolo = $riga->titolo;
	$data = $riga->data;

	$text .= '<tr>
	<td>'.$autore.'</td>
	<td><a href="'.$cms->url_index().'news.php?titolo='.$titolo.'">'.$titolo.'</a></td>
	<td>'.$data.'</td>
	</tr>';
}

// Chiudo la tabella
$text .= '</table>';

// Mi disconnetto dal database
$db->disconnettidb();

$smarty->assign("titolo", "Ultimi commenti");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
