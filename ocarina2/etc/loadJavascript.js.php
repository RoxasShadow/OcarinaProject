<?php
/**
	/etc/loadJavascript.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di ottimizzare il caricamento di tutti gli script javascript che si trovano in /etc/js/.
   È possibile includerlo direttamente nel file di template come fosse un semplice script. */
header('Content-type: text/javascript');
header('Last-Modified: '.gmstrftime("%a, %d %b %Y %H:%M:%S GMT", getlastmod()));
require_once('../core/class.Configuration.php');
require_once('jsmin.php');
$config = new Configuration();
$apri = opendir($config->config[0]->root_index.'/etc/js/');
$f = array();
while($script = readdir($apri))
	if((is_file($config->config[0]->root_index.'/etc/js/'.$script)) && (substr($script, -3) == '.js'))
		$f[] = $script;
sort($f); // Ordine alfabetico
$text = '';
for($i=0, $count=count($f), $content=''; $i<$count; ++$i) {
	$handler = fopen('js/'.$f[$i], 'r');
	$text .= fread($handler, filesize('js/'.$f[$i]));
	fclose($handler);
}
echo JSMin::minify($text);
unset($config);
