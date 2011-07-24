<?php
/* Questa classe permette di creare una descrizione di un testo per l'omonimo metatag */
function autodescription($stringa, $lunghezza) {
	$stringa = strip_tags($stringa);
	$stringa = str_replace('"', '', $stringa);
	$sub_string = substr($stringa,0,$lunghezza);
	$pos_break = strrpos($sub_string," ");
	$description = trim(substr($sub_string,0, $pos_break));
	$description = strip_tags($description);
	return $description.'...';
}
?>
