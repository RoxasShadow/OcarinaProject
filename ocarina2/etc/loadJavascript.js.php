<?php
/**
	/etc/loadJavascript.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di ottimizzare il caricamento di tutti gli script javascript che si trovano in /etc/js/.
   È possibile includerlo direttamente nel file di template come fosse un semplice script. */
header('Content-type: text/javascript');
header('Last-Modified: '.gmstrftime("%a, %d %b %Y %H:%M:%S GMT", getlastmod()));
if(file_exists('js.cache'))
	die(file_get_contents('js.cache'));
require_once('../core/class.Configuration.php');
require_once('jsmin.php');
$config = new Configuration();
$f = array();
$apri = opendir($config->config[0]->root_index.'/etc/js/');
while($script = readdir($apri))
	if((is_file($config->config[0]->root_index.'/etc/js/'.$script)) && (substr($script, -3) == '.js'))
		$f[] = $script;
closedir($apri);
unset($config);
sort($f); // Ordine alfabetico
$script = '';
for($i=0, $count=count($f), $content=''; $i<$count; ++$i) {
	$handler = fopen('js/'.$f[$i], 'r');
	$script .= fread($handler, filesize('js/'.$f[$i]));
	fclose($handler);
}
$script = JSMin::minify($script);
$handler = fopen('js.cache', 'w');
fwrite($handler, $script);
fclose($handler);
die(file_get_contents('js.cache'));
