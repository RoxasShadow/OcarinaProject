<?php
/* Cancella l'immagine arrivata in GET da elencoimmagini.php e rimanda lì una volta cancellata */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

$img = $cms->dir_immagini().$_GET['img'];
unlink($img);

// Aggiorno i log se sono attivi
if($cms->cmslog() == 1) {
	$codice = $_COOKIE[$func->cookie()];
	$azione = 'cancellato un\' immagine ('.$img.')';
	$db->log($codice, $azione);
}

header("Location: elencoimmagini.php");
exit;
?>
