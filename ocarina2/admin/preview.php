<?php
/**
	/admin/preview.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
$ocarina = new Ocarina();
$type = ((isset($_GET['type'])) && ($_GET['type'] !== '')) ? $ocarina->purgeByXSS($_GET['type']) : '';
$text = ((isset($_POST['text'])) && ($_POST['text'] !== '')) ? $ocarina->purgeByXSS($_POST['text']) : die('Text not found.');

if($ocarina->config[0]->plugin == 1) {
	$plugins = Plugin::listPlugins();
	$varList = $ocarina->getValues();
	foreach($plugins as $element)
		if((Plugin::getMetadata($element, 'enabled', '') == 'true') && (Plugin::getMetadata($element, 'textmanipulation', '') == 'true') && (file_exists($ocarina->config[0]->root_index.'/plugin/plugins/'.Plugin::getMetadata($element, 'path', ''))))
			try {
				$plugin = Plugin::loadPlugin($element);
				$text = $plugin->manipulate($type, $text);
			}
			catch(Exception $e) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($element, $e->getMessage());
				echo '<!-- '.$e->getMessage().' -->';
			}
	unset($plugins);
}
echo $text;
