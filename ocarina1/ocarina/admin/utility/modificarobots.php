<?php
/* Permette di modificare il file robots.txt */
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

/* La lettura del robots.txt */

// Apro il file
$robots = @fopen($cms->root()."robots.txt","r");

// Lo leggo
$leggirobots = @fread($robots,@filesize($cms->root()."robots.txt"));
$leggirobots = '#Robots.txt generato con admin il giorno '.$data->data('-').".\n".$leggirobots;
/* La modifica del robots.txt */

if(isset($_POST['modificarobots'])) {
	$newrobots = $_POST['newrobots'];

	// Apro il file
	$robots2 = @fopen($cms->root()."robots.txt","w");

	// Ci scrivo i dati
	fwrite($robots2, '');
	fwrite($robots2, $newrobots);

	// Lo chiudo
	fclose($robots2);

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$codice = $_COOKIE[$func->cookie()];
		$azione = 'modificato il file robots.txt';
		$db->log($codice, $azione);
	}

	// Mando l' avviso
	$text = 'Il file robots.txt è stato modificato.';
	$smarty->assign("titolo", "Robots.txt");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

/* Il form */

$text = 'Il file robots.txt istruisce i motori di ricerca su come devono comportarsi per indicizzare le pagine, ovvero
inserirle nei loro database.<br />
Per un rapido tutorial sulla sintassi consultare la pagina dedicata su <a href="http://it.wikipedia.org/wiki/Robots.txt" target="_blank">Wikipedia</a>.<br /><br />

<form action="" method="post">
'.$func->textarea('newrobots',$leggirobots).'<br /><input name="modificarobots" type="submit" value="Modifica" /><br />
</form>';

$smarty->assign("titolo", "Robots.txt");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
