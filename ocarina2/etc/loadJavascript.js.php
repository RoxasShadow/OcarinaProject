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
$config = new Configuration();
$apri = opendir($config->config[0]->root_index.'/etc/js/');
$f = array();
while($script = readdir($apri))
	if((is_file($config->config[0]->root_index.'/etc/js/'.$script)) && (substr($script, -3) == '.js'))
		$f[] = $script;

for($i=0, $count=count($f), $content=''; $i<$count; ++$i)
	$content .= 'var element=document.createElement("script");element.src="'.$config->config[0]->url_index.'/etc/js/'.$f[$i].'";document.body.appendChild(element);
	';

echo 'function downloadJSAtOnload(){'.$content.'}if(window.addEventListener)window.addEventListener("load",downloadJSAtOnload,false);else if(window.attachEvent)window.attachEvent("onload",downloadJSAtOnload);else window.onload=downloadJSAtOnload;';
unset($config);
