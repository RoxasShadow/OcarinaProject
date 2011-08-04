<?php
/**
	/admin/plugin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
require_once('../core/class.Plugin.php');

$ocarina = new Ocarina();

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 34).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1)) {
	$pluginList = Plugin::listPlugins();
	$plugins = array();
	foreach($pluginList as $name) {
		$plugins['name'][] = Plugin::getMetadata($name, 'name', '');
		$plugins['version'][] = Plugin::getMetadata($name, 'version', '');
		$plugins['author'][] = Plugin::getMetadata($name, 'author', '');
		$plugins['website'][] = Plugin::getMetadata($name, 'website', '');
		$plugins['description'][] = Plugin::getMetadata($name, 'description', '');
		$plugins['path'][] = Plugin::getMetadata($name, 'path', '');
		$plugins['enabled'][] = Plugin::getMetadata($name, 'enabled', '');
	}
	$ocarina->addValue('plugins', $plugins);
	unset($plugin);
}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('plugin.tpl');
