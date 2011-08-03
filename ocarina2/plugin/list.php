<?php
list($usec, $sec) = explode(' ', microtime());
$time = ((float)$usec + (float)$sec);
require_once('../core/class.Plugin.php');

echo '<b>Plugin installati:</b><br /><br />
<table>
<tr>
<td><b>Nome</b></td>
<td><b>Autore</b></td>
<td><b>Descrizione</b></td>
<td><b>Percorso</b></td>
<td><b>Abilitato</b></td>
</tr>';
$listPlugin = Plugin::listPlugins();
foreach($listPlugin as $name)
	echo '<tr><td>'.$name.'</td><td>'.Plugin::getMetadata($name, 'author', '').'</td><td>'.Plugin::getMetadata($name, 'description', '').'</td><td>'.Plugin::getMetadata($name, 'path', '').'</td><td>'.Plugin::getMetadata($name, 'enabled', '').'</td></tr>';
echo '</table><br /><br />';

echo '<b>Plugin in funzione:</b><br /><br />';
foreach($listPlugin as $name) {
	if(Plugin::getMetadata($name, 'enabled', '') == 'true') {
		echo '<b>'.$name.':</b><br />';
		try {
			$plugin = Plugin::loadPlugin($name);
			$plugin->main();
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		echo '<hr />';
	}
}
list($usec, $sec) = explode(' ', microtime());
echo 'Time: ';
echo ((float)$usec + (float)$sec) - $time;
