<?php
/**
	/admin/plugin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
require_once('../core/class.Plugin.php');
$ocarina = new Ocarina();
$plugin = ((isset($_FILES['plugin'])) && ($_FILES['plugin'] !== '')) ? $_FILES['plugin'] : '';
$disinstall = ((isset($_GET['disinstall'])) && ($_GET['disinstall'] !== '')) ? $ocarina->purge($_GET['disinstall']) : '';
$submit = ($plugin !== '') ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 34).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1)) {
	if($disinstall !== '')
		if(!Plugin::pluginExists($disinstall))
			$ocarina->addValue('result', $ocarina->getLanguage('disinstallplugin', 0));
		elseif((!Plugin::disinstallPlugin($disinstall)) || (!$ocarina->deleteDir($ocarina->config[0]->root_index.'/plugin/plugins/'.$disinstall.'/')))
			$ocarina->addValue('result', $ocarina->getLanguage('disinstallplugin', 1));
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('disinstallplugin', 2));
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Plugin `'.$disinstall.'` disinstalled.');
		}
	elseif($submit)
		if($plugin !== '')
			if(Plugin::pluginExists(substr($plugin['name'], 0, -4)))
				$ocarina->addValue('result', $ocarina->getLanguage('upload', 3));
			elseif(!$upload = Plugin::installPlugin($plugin))
				$ocarina->addValue('result', $ocarina->getLanguage('upload', 1));
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('upload', 2));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Plugin `'.substr($plugin['name'], 0, -4).'` installed.');
			}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('upload', 1));
	else {
		$pluginList = Plugin::listPlugins();
		$plugins = array();
		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		foreach($pluginList as $name) {
			$plugins['name'][] = Plugin::getMetadata($name, 'name', '');
			$plugins['version'][] = Plugin::getMetadata($name, 'version', '');
			$plugins['author'][] = Plugin::getMetadata($name, 'author', '');
			$plugins['website'][] = Plugin::getMetadata($name, 'website', '');
			$plugins['description'][] = (Plugin::getMetadata($name, 'description['.$language.']', '') !== '') ? Plugin::getMetadata($name, 'description['.$language.']', '') : Plugin::getMetadata($name, 'description', '');
			$plugins['path'][] = Plugin::getMetadata($name, 'path', '');
			$plugins['enabled'][] = Plugin::getMetadata($name, 'enabled', '');
		}
		$ocarina->addValue('plugins', $plugins);
		unset($plugin);
	}
}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('plugin.tpl');
