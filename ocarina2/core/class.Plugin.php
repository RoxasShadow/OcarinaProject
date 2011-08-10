<?php
/**
	core/class.Plugin.php
	(C) Giovanni Capuano 2011
*/

/* Classe basata su PluginRepository di HTML.it */
require_once('interface.FrameworkPlugin.php');

final class Plugin {
	private static $instance = NULL;
	private $plugins = array();
	private static $root_index = '/var/www/htdocs/ocarina2';
	
	private static function getInstance() {
		if(self::$instance == NULL)
			self::$instance = new Plugin();
		return self::$instance;
	}
	
	private function __construct() {
		$plugin = NULL;
		if(!file_exists(self::$root_index.'/plugin/plugins.cfg')) {
			$f = fopen(self::$root_index.'/plugin/plugins.cfg', 'w');
			fwrite($f, '');
			fclose($f);
		}
		foreach(file(self::$root_index.'/plugin/plugins.cfg') as $line) {
			$line = trim($line);
			if((preg_match('/##/is', $line)) || (preg_match('/\/\//is', $line)) || (preg_match('/\'\'/is', $line)) || (preg_match('/--/is', $line)) || (strlen($line) == 0))
				continue;
			list($attr, $value) = array_map('trim', explode('=', $line));
			if($attr == 'name') {
				if(!is_null($plugin))
					$this->plugins[$plugin['name']] = $plugin;
				$plugin = array();
			}
			$plugin[$attr] = $value;
		}
		if(!is_null($plugin) && array_key_exists('name', $plugin))
			$this->plugins[$plugin['name']] = $plugin;
		unset($plugin);
	}
	
	private function __distruct() {
		unset(self::$instance, $this->plugins);
	}
	
	public static function loadPlugin($name, $force = false) {
		$repository = Plugin::getInstance();
		if(!array_key_exists($name, $repository->plugins))
			throw new Exception('Il plugin '.$name.' non esiste.');
		$plugin = $repository->plugins[$name];
		if(($plugin['enabled'] == 'false') && (!$force))
			throw new Exception('Il plugin '.$name.' non è attivo.');
		if(!array_key_exists('__class__', $plugin)) {
			$plugin['path'] = self::$root_index.'/plugin/plugins/'.$plugin['path'];
			if(!file_exists($plugin['path']))
				throw new Exception('Impossibile caricare il plugin '.$name.'.');
			require_once($plugin['path']);
			$class_name = basename($plugin['path'], '.php');
			$reflection = new ReflectionClass($class_name);
			$found = false;
			/* Solo i plugin che implementano l'interfaccia FrameworkPlugin sono validi. */
			foreach($reflection->getInterfaces() as $interfaces)
				$found = $interfaces->getName() == 'FrameworkPlugin';
			if(!$found)
				throw new Exception('Il plugin non può essere caricato.');
			$plugin['__class__'] = $class_name;
		}
		unset($repository);
		return new $plugin['__class__'];
	}
	
	public static function getMetadata($name, $meta, $default = NULL) {
		$repository = Plugin::getInstance();
		if(!array_key_exists($name, $repository->plugins))
			throw new Exception('Il plugin '.$name.' non esiste.');
		$plugin = $repository->plugins[$name];
		unset($repository);
		return array_key_exists($meta, $plugin) ? $plugin[$meta] : $default;
	}
	
	public static function pluginExists($name) {
		if(trim($name) == '')
			return false;
		$repository = Plugin::getInstance();
		$exists = array_key_exists($name, $repository->plugins);
		unset($repository);
		return $exists;
	}
	
	public static function listPlugins() {
		$repository = Plugin::getInstance();
		return array_keys($repository->plugins);
	}
	
	/* Installa un plugin. */
	public static function installPlugin($FILES) {
		require_once(Plugin::$root_index.'/etc/pclzip.lib.php');
		$path = Plugin::$root_index.'/plugin/plugins/';
		if((empty($FILES)) || (!is_array($FILES)))
			return false;
		do {
			/* Upload */
			if($_FILES['plugin']['error'] == 0) {
				if($_FILES['plugin']['type'] !== 'application/zip')
					return false;
				if(!copy($_FILES['plugin']['tmp_name'], $path.$_FILES['plugin']['name']))
					return false;
			}
			/* Unzip */
			$unzip = new PclZip($path.$_FILES['plugin']['name']);
			if($unzip->extract(PCLZIP_OPT_PATH, $path) == 0)
				return false;
			/* Elimino l'archivio */
			if(file_exists($path.$_FILES['plugin']['name']))
				unlink($path.$_FILES['plugin']['name']);
		} while(false);
		$config = '';
		
		$f = fopen($path.substr($_FILES['plugin']['name'], 0, -4).'/plugin.cfg', 'r');
		$config = fread($f, filesize($path.substr($_FILES['plugin']['name'], 0, -4).'/plugin.cfg'));
		fclose($f);
		
		$f = fopen(Plugin::$root_index.'/plugin/plugins.cfg', 'a+');
		fwrite($f, $config);
		fclose($f);
		
		self::$instance = new Plugin(); // Nuova istanza
		$plugin = Plugin::loadPlugin(substr($_FILES['plugin']['name'], 0, -4), true);
		if(Plugin::pluginExists(substr($_FILES['plugin']['name'], 0, -4)))
			$config = $plugin->install();
		unlink($path.substr($_FILES['plugin']['name'], 0, -4).'/plugin.cfg');
		return $config;
	}
	
	/* Disinstalla suna skin. */
	public static function disinstallPlugin($name) {
		if(!is_dir(Plugin::$root_index.'/plugin/plugins/'.$name.'/'))
			return false;
		$plugin = Plugin::loadPlugin($name, true);
		$disinstall = $plugin->disinstall();
		unset($plugin);
		return $disinstall;
	}
}
