<?php
/**
	core/class.Plugin.php
	(C) Giovanni Capuano 2011
*/

require_once('interface.FrameworkPlugin.php');

final class Plugin {
	private static $instance = NULL;
	public $configFileName = './plugin/plugins.cfg';
	
	private static function getInstance() {
		if(self::$instance == NULL)
			self::$instance = new Plugin();
		return self::$instance;
	}
	
	private $plugins;
	
	private function __construct() {
		$this->plugins = array();
		
		// Loading
		$plugin = NULL;
		foreach(file($this->configFileName) as $line) {
			$line = trim($line);
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
	}
	
	public static function loadPlugin($name) {
		$repository = Plugin::getInstance();
		if(!array_key_exists($name, $repository->plugins))
			throw new Exception('Il plugin '.$name.' non esiste.');
		$plugin = $repository->plugins[$name];
		if($plugin['enabled'] == 'false')
			throw new Exception('Il plugin '.$name.' è disattivato.');
		if(!array_key_exists('__class__', $plugin)) {
			if(!file_exists($plugin['path']))
				throw new Exception('Impossibile caricare il plugin '.$name.'.');
			require_once($plugin['path']);
			$class_name = basename($plugin['path'], '.php');
			$reflection = new ReflectionClass($class_name);
			$found = false;
			foreach($reflection->getInterfaces() as $interfaces)
				$found = $interfaces->getName() == 'FrameworkPlugin';
			if(!$found)
				throw new Exception('Il plugin non può essere caricato');
			$plugin['__class__'] = $class_name;
		}
		return new $plugin['__class__'];
	}
	
	public static function getMetadata($name, $meta, $default = NULL) {
		$repository = Plugin::getInstance();
		if(!array_key_exists($name, $repository->plugins))
			throw new Exception('Il plugin '.$name.' non esiste.');
		$plugin = $repository->plugins[$name];
		return array_key_exists($meta, $plugin) ? $plugin[$meta] : $default;
	}
	
	public static function listPlugins() {
		$repository = Plugin::getInstance();
		return array_keys($repository->plugins);
	}
}
	
