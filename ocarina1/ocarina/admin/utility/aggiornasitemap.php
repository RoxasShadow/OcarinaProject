<?php
/* Aggiorna la sitemap */
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
	$smarty->assign("titolo", "Aggiorna sitemap");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

/* Il form */

$text = 'La sitemap è un file XML che contiene, secondo una precisa formattazione, tutte le pagine di un sito e serve 
ai motori di ricerca per analizzare completamente un sito.<br /><br />

<div align="center">
<form action="" method="post">
<input type="submit" name="aggiornasitemap" value="Aggiorna sitemap">
</form>
</div>';

$smarty->assign("titolo", "Aggiorna sitemap");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
