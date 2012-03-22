<?php
/* Riceve la skin da modificaskin.php e la modifica */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

/* Modifica skin */

if((!isset($_POST['modificaskin'])) AND (!isset($_POST['editaskin']))) {
	$text = 'Questa pagina è richiamabile solo da <a href="modificaskin.php">modifica skin</a>.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Modifica skin");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	$db->disconnettidb(); // Posso disconnettermi dal database
	exit;
}

$skin = $_POST['skin'];
$template = $_POST['template']; 
	
// Apro il file
$apritemplate=fopen($cms->dir_smarty().'/templates/'.$skin.'/'.$template,"r");

// Lo leggo
$leggitemplate=fread($apritemplate,filesize($cms->dir_smarty().'/templates/'.$skin.'/'.$template));

// Lo chiudo
fclose($apritemplate);

// Se arriva la skin modificata si modifica
if(isset($_POST['editaskin'])) {
	$skin = $_POST['skin'];
	$template = $_POST['template']; 
	$newtemplate = $func->rescape($_POST['newtemplate']);

	// Apro il file
	$apritemplate2=fopen($cms->dir_smarty().'/templates/'.$skin.'/'.$template,"w");

	// Ci scrivo i dati
	fwrite($apritemplate2, '');
	fwrite($apritemplate2, $newtemplate);

	// Lo chiudo
	fclose($apritemplate2);

	$text = 'Il template è stato modificato.';

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$codice = $_COOKIE[$func->cookie()];
		$azione = 'modificato una skin';
		$db->log($codice, $azione);
	}

	// Visualizzo la pagina
	$smarty->assign("titolo", "Modifica skin");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

$text = '<form action="" method="post">
<textarea rows="10" cols="50" name="newtemplate">'.$func->rescape($leggitemplate).'</textarea><br />
<input type="hidden" name="skin" value="'.$_POST['skin'].'">
<input type="hidden" name="template" value="'.$_POST['template'].'">
<input name="editaskin" type="submit" value="Modifica" /><br />
</form>';

// Visualizzo la pagina
$smarty->assign("titolo", "Modifica skin");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
