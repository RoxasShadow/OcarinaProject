<?php
/* Tutte le immagini caricate */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

/* Aggiorno la sitemap */

if(isset($_POST['aggiornasitemap'])) {

	if($cms->sitemapalert() == 1) {
		$alert = 1;
	}
	elseif($cms->sitemapalert() == 0) {
		$alert = 0;
	}

	$db->aggiornasitemap($cms->url(), $cms->linknews(), $cms->linksezioni(), $cms->root(), $alert);

	// Mando l' avviso
	$text = 'La sitemap è stata aggiornata.';
	$smarty->assign("titolo", "Elenco immagini");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Prelevo le cartelle delle immagini, le apro, estraggo il nome della cartella e creo un array per ognuna di esse
$dir = $cms->dir_immagini();
$dir2 = $cms->dir_immagini().'news/';
$dir3 = $cms->dir_immagini().'sezioni/';
$apri = opendir($dir);
$apri2 = opendir($dir2);
$apri3 = opendir($dir3);
$f = array();
$f2 = array();
$f3 = array();

// Le immagini generali
$text = '<b>Non specificato</b><br /><br />';

// Leggo e inserisco tutte le immagini in un array che poi ordino
while (false !== ($immagini = readdir($apri))) {
	if ($immagini != '.' && $immagini != '..' && $immagini != 'sezioni' && $immagini != 'news' && $immagini != 'emoticons') {
		$f[] = $immagini;
	}
}
sort($f);

// Stampo l'array
foreach($f as $immagini) {
	$text .= '<a href="'.$cms->url_immagini().$immagini.'" target="_blank">'.$immagini.'</a>      <a href="cancellaimmagine.php?img='.$immagini.'">[cancella]</a><br />';
}

// Le immagini delle news
$text .= '<br /><b>News</b><br /><br />';

while (false !== ($immagini2 = readdir($apri2))) {
	if ($immagini2 != '.' && $immagini2 != '..') {
		$f2[] = $immagini2;
	}
}
sort($f2);

foreach($f2 as $immagini2) {
	$text .= '<a href="'.$cms->url_immagini().'/news/'.$immagini2.'" target="_blank">'.$immagini2.'</a>      <a href="cancellaimmagine.php?img=news/'.$immagini2.'">[cancella]</a><br />';
}

// Le immagini delle sezioni
$text .= '<br /><b>Sezioni</b><br /><br />';
	while (false !== ($immagini3 = readdir($apri3))) {
	if ($immagini3 != '.' && $immagini3 != '..') {
		$f3[] = $immagini3;
	}
}
sort($f3);

foreach($f3 as $immagini3) {
	$text .= '<a href="'.$cms->url_immagini().'sezioni/'.$immagini3.'" target="_blank">'.$immagini3.'</a>      <a href="cancellaimmagine.php?img=sezioni/'.$immagini3.'">[cancella]</a><br />';
}

$smarty->assign("titolo", "Elenco immagini");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
