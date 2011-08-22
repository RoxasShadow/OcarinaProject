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
		$dir = opendir(self::$root_index.'/plugin/plugins/');
		$f = array();
		while($cfg = readdir($dir))
			if(($cfg !== '.') && ($cfg !== '..') && (is_dir(self::$root_index.'/plugin/plugins/'.$cfg)))
				$f[] = self::$root_index.'/plugin/plugins/'.$cfg.'/plugin.cfg';
		foreach($f as $v)
			foreach(file($v) as $line) {
				$line = trim($line);
				$line = preg_replace('/\/\\*[\\s\S]*?\\*\//', '', $line); // /*cmt*/ /(*^n)cmt(*^m)/
				$line = preg_replace('/\/\/[\\s\S]/', '', $line); // //cmt (:D)
				$line = preg_replace('/##[\\s\S]/', '', $line); // ##cmt
				$line = preg_replace('/;;[\\s\S]/', '', $line); // ;;cmt
				$line = preg_replace('/\'\'[\\s\S]/', '', $line); // ''cmt
				if(strlen($line) == 0)
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
			throw new Exception("<b>Plugin system's log:</b> `$name` not exists.");
		$plugin = $repository->plugins[$name];
		if(($plugin['enabled'] == 'false') && (!$force))
			throw new Exception("<b>Plugin system's log:</b> `$name` not enabled.");
		if(!array_key_exists('__class__', $plugin)) {
			$plugin['path'] = self::$root_index.'/plugin/plugins/'.$plugin['path'];
			if(!file_exists($plugin['path']))
				throw new Exception("<b>Plugin system's log:</b> Impossible to load `$name`");
			require_once($plugin['path']);
			$class_name = basename($plugin['path'], '.php');
			$reflection = new ReflectionClass($class_name);
			$found = false;
			/* Solo i plugin che implementano l'interfaccia FrameworkPlugin sono validi. */
			foreach($reflection->getInterfaces() as $interfaces)
				$found = $interfaces->getName() == 'FrameworkPlugin';
			if(!$found)
				throw new Exception("<b>Plugin system's log:</b> Impossible to load `$name`");
			$plugin['__class__'] = $class_name;
		}
		unset($repository);
		return new $plugin['__class__'];
	}
	
	public static function getMetadata($name, $meta, $default = NULL) {
		$repository = Plugin::getInstance();
		if(!array_key_exists($name, $repository->plugins))
			throw new Exception("<b>Plugin system's log:</b> `$name` not exists.");
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
	
	public static function pluginActive($name) {
		if(!Plugin::pluginExists($name))
			return false;
		$f = fopen(self::$root_index.'/plugin/plugins/'.$name.'/plugin.cfg', 'r');
		$cfg = str_replace('enabled = false', 'enabled = true', fread($f, filesize(self::$root_index.'/plugin/plugins/'.$name.'/plugin.cfg')));
		fclose($f);
		$f = fopen(self::$root_index.'/plugin/plugins/'.$name.'/plugin.cfg', 'w');
		fwrite($f, $cfg);
		fclose($f);
		self::$instance = new Plugin();
		return (Plugin::getMetadata($name, 'enabled', '') == 'true') ? true : false;
	}
	
	public static function pluginDeactive($name) {
		if(!Plugin::pluginExists($name))
			return false;
		$f = fopen(self::$root_index.'/plugin/plugins/'.$name.'/plugin.cfg', 'a+');
		$cfg = str_replace('enabled = true', 'enabled = false', fread($f, filesize(self::$root_index.'/plugin/plugins/'.$name.'/plugin.cfg')));
		fwrite($f, $cfg);
		fclose($f);
		self::$instance = new Plugin();
		return (Plugin::getMetadata($name, 'enabled', '') == 'false') ? true : false;
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
		
		self::$instance = new Plugin(); // Nuova istanza
		$plugin = Plugin::loadPlugin(substr($_FILES['plugin']['name'], 0, -4), true);
		if(Plugin::pluginExists(substr($_FILES['plugin']['name'], 0, -4)))
			$config = $plugin->install();
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
