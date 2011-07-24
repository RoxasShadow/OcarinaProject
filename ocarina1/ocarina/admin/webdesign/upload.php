<?php
/* Carica e decomprime la skin */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";
include_once "../../etc/class.PclZip.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Controllo se arriva da installaskin.php
if(isset($_POST['upload'])) {

	// Controllo che non ci siano stati errori nell'upload (codice = 0)  
	if ($_FILES['uploadfile']['error'] == 0){

		// Controllo che il file sia in formato zip 
		if ($_FILES['uploadfile']['type'] != "application/zip") die("Formato file non valido, è permesso solo il formato .zip"); 
		 
		// Copio il file dalla cartella temporanea a quella di destinazione mantenendo il nome originale  
		copy($_FILES['uploadfile']['tmp_name'], $cms->dir_smarty().'templates/'.$_FILES['uploadfile']['name']) or die("Impossibile caricare la skin."); 

		// Decomprimo lo zip
		$temp_unzip = $cms->dir_smarty().'templates/';
		$temp_file= $cms->dir_smarty().'templates/'.$_FILES['uploadfile']['name'];
		$archive = new PclZip($temp_file);
		$list = $archive->extract(PCLZIP_OPT_PATH, $temp_unzip);
		$text .= "La skin è stata installata.";

		// Visualizzo la pagina
		$smarty->assign("titolo", "Carica skin");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index.tpl");
		exit;
	}
	else{ 
		// Errore generico 
		die("Errore, impossibile caricare il file");
	}
}
else {
	die("Questa pagina è richiamabile solo da <a href=\"installaskin.php\">installa skin</a>.");
}

// Visualizzo la pagina
$smarty->assign("titolo", "Carica skin");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
