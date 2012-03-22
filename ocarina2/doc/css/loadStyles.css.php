<?php
/**
	/etc/loadStyles.css.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di ottimizzare il caricamento di tutti i file CSS che si trovano nella cartella in cui è contenuto il file.
   È possibile includerlo direttamente nel file di template come fosse un semplice CSS. */
header('Content-type: text/css');
header('Last-Modified: '.gmstrftime("%a, %d %b %Y %H:%M:%S GMT", getlastmod()));
if(file_exists('css.cache'))
	die(file_get_contents('css.cache'));
require_once('cssmin.php');
$f = array();
$apri = opendir('./');
while($style = readdir($apri))
	if((is_file($style)) && (substr($style, -4) == '.css'))
		$f[] = $style;
closedir($apri);
sort($f); // Ordine alfabetico
$style = '';
for($i=0, $count=count($f), $content=''; $i<$count; ++$i) {
	$handler = fopen($f[$i], 'r');
	$style .= fread($handler, filesize($f[$i]));
	fclose($handler);
}
$style = CssMin::minify($style);
$handler = fopen('css.cache', 'w');
fwrite($handler, $style);
fclose($handler);
die(file_get_contents('css.cache'));
