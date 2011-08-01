<?php
/**
	core/class.MySQL.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Utilities.php');

/* Questa classe mette a disposizione dei metodi per gestire il database. */
class MySQL extends Utilities {
	private $host = 'localhost';
	private $username = 'root';
	private $password = 'kronos';
	private $database = 'ocarina2';
	public $prefix = '';
	public $caching = true; // `true` -> Caching abilitato; `false` -> Caching disabilitato.
	private $storage = '/var/www/htdocs/ocarina2/cache/';
	
	public function __construct() {
		if(!mysql_selectdb($this->database, mysql_connect($this->host, $this->username, $this->password)))
			die('Database connection failed.');
		elseif($this->caching)
			if(!is_dir($this->storage))
				die('The cache directory not exists.');
			elseif(!is_writable($this->storage))
				die('The cache directory is not writable. You should fix the permissions.'); 
	}
	
	public function __distruct() {
		mysql_close();
	}
	
	/* Private methods. */
	private function serial($file, $obj) {
		$f = fopen($this->storage.$file, 'w');
		fwrite($f, serialize($obj));
		fclose($f);
	}
	
	private function unserial($file) {
		$filetime = filemtime($this->storage.$file);
		$f = fopen($this->storage.$file, 'r');
		$content = fread($f, filesize($this->storage.$file));
		fclose($f);
		return unserialize($content);
	}
	
	private function is_cachable($query) {
		return !preg_match('/\s*(INSERT[\s]+|DELETE[\s]+|UPDATE[\s]+|REPLACE[\s]+|CREATE[\s]+|ALTER[\s]+|SET[\s]+|FOUND_ROWS[\s]+|SQL_NO_CACHE[\s]+)/si', $query);
	}
	
	private function is_cached($file) {
		return file_exists($this->storage.$file) ? true : false;
	}
	
	private function cache_remove($file) {
		if($this->is_cached($file))
			unlink($this->storage.$file);
	}
	
	/* Public methods. */
	public function cache_clean() {
		$dir = opendir($this->storage);
		while($file = readdir($dir))
			if(substr($file, -6) == '.cache')
				$this->cache_remove($file);
	}
	
	public function query($query) {
		if(!$result = mysql_query($query))
			return false;
		if($this->caching)
			if(!$this->is_cachable($query))
				$this->cache_clean();
		return $result;
	}
	
	public function get($query) {
		if(!$this->caching) {
			if(!$result = mysql_query($query))
				return false;
			$array = array();
			while($fetch = mysql_fetch_object($result))
				array_push($array, $fetch);
			mysql_free_result($result);
			return empty($array) ? false : $array;
		}
		$file = md5($query).'.cache';
		if($this->is_cached($file))
			return $this->unserial($file);
		if(!$result = mysql_query($query))
			return false;
		$array = array();
		while($fetch = mysql_fetch_object($result))
			array_push($array, $fetch);
		mysql_free_result($result);
		if(!$this->is_cached($file))
			$this->serial($file, $array);
		return empty($array) ? false : $array;
	}
	
	public function count($query) {
		if($this->caching) {
			$file = md5($query).'.cache';
			if($this->is_cached($file)) {
				$count = count($this->unserial($file));
				return ((!$count) || (!is_numeric($count)) || ((int)$count <= 0)) ? 0 : (int)$count;
			}
		}
		if(!$result = mysql_query($query))
			return false;
		$count = mysql_num_rows($result);
		return ((!$count) || (!is_numeric($count)) || ((int)$count <= 0)) ? 0 : (int)$count;
	}
	
	public function getEnum($query) {
		if(!$result = mysql_query($query));
			return false;
		if(!$rows = mysql_fetch_row($result))
			return false;
		$category = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $rows[1]));
		return (empty($category)) ? false : $category;
	}
	
	public function getColumns($query) {
		if(!$result = mysql_query($query))
			return false;
		$array = array();
		if(!$columns = mysql_num_fields($result))
			return false;
		for($i=0; $i<$columns; $i++)
			$array[$i] = mysql_field_name($result, $i);
		return (empty($array)) ? false : $array;
	}
	
	/* Crea le tabelle per il database. */
	public function createDatabase() {
		$array = array(
			"CREATE TABLE IF NOT EXISTS `{$this->prefix}annunci` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `autore` varchar(100) NOT NULL,
			  `titolo` varchar(100) NOT NULL,
			  `minititolo` varchar(100) NOT NULL,
			  `contenuto` text NOT NULL,
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`minititolo`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}commenti` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `autore` varchar(100) NOT NULL,
			  `contenuto` text NOT NULL,
			  `news` varchar(100) NOT NULL,
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `approvato` tinyint(1) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}configurazione` (
			  `nomesito` varchar(100) NOT NULL,
			  `email` varchar(100) NOT NULL,
			  `bbcode` tinyint(1) NOT NULL,
			  `registrazioni` tinyint(1) NOT NULL,
			  `validazioneaccount` tinyint(1) NOT NULL,
			  `commenti` tinyint(1) NOT NULL,
			  `approvacommenti` tinyint(1) NOT NULL,
			  `log` tinyint(1) NOT NULL,
			  `cookie` varchar(20) NOT NULL,
			  `loginexpire` int(10) NOT NULL,
			  `skin` varchar(50) NOT NULL,
			  `description` text NOT NULL,
			  `limitenews` int(10) NOT NULL,
			  `impaginazionenews` int(10) NOT NULL,
			  `limiteonline` int(10) NOT NULL,
			  `permettivoto` tinyint(1) NOT NULL,
			  `url` varchar(100) NOT NULL,
			  `url_index` varchar(100) NOT NULL,
			  `url_admin` varchar(100) NOT NULL,
			  `url_rendering` varchar(100) NOT NULL,
			  `url_immagini` varchar(100) NOT NULL,
			  `root` varchar(100) NOT NULL,
			  `root_index` varchar(100) NOT NULL,
			  `root_admin` varchar(100) NOT NULL,
			  `root_rendering` varchar(100) NOT NULL,
			  `root_immagini` varchar(100) NOT NULL,
			  `versione` varchar(5) NOT NULL,
			  `totalevisitatori` int(10) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}log` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `nickname` varchar(100) NOT NULL,
			  `azione` varchar(100) NOT NULL,
			  `ip` varchar(20) NOT NULL,
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `useragent` varchar(100) NOT NULL,
			  `referer` varchar(100) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}news` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `autore` varchar(100) NOT NULL,
			  `titolo` varchar(100) NOT NULL,
			  `minititolo` varchar(100) NOT NULL,
			  `contenuto` text NOT NULL,
			  `categoria` enum('Senza categoria') NOT NULL DEFAULT 'Senza categoria',
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `dataultimamodifica` varchar(10) NOT NULL,
			  `oraultimamodifica` varchar(10) NOT NULL,
			  `autoreultimamodifica` varchar(100) NOT NULL,
			  `approvato` tinyint(1) NOT NULL,
			  `voti` int(100) NOT NULL,
			  `visite` int(100) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`minititolo`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}pagine` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `autore` varchar(100) NOT NULL,
			  `titolo` varchar(100) NOT NULL,
			  `minititolo` varchar(100) NOT NULL,
			  `contenuto` text NOT NULL,
			  `categoria` enum('Senza categoria') DEFAULT 'Senza categoria',
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `dataultimamodifica` varchar(10) NOT NULL,
			  `oraultimamodifica` varchar(10) NOT NULL,
			  `autoreultimamodifica` varchar(100) NOT NULL,
			  `approvato` tinyint(1) NOT NULL,
			  `voti` int(100) NOT NULL,
			  `visite` int(100) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`minititolo`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}personalmessage` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `mittente` varchar(100) NOT NULL,
			  `destinatario` varchar(100) NOT NULL,
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `oggetto` varchar(100) NOT NULL,
			  `contenuto` text NOT NULL,
			  `letto` tinyint(1) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`mittente`,`destinatario`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}utenti` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `nickname` varchar(100) NOT NULL,
			  `password` varchar(100) NOT NULL,
			  `secret` varchar(40) NOT NULL,
			  `email` varchar(100) NOT NULL,
			  `grado` tinyint(1) NOT NULL,
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `lastlogout` varchar(10) NOT NULL,
			  `ip` varchar(20) NOT NULL,
			  `codiceregistrazione` varchar(40) NOT NULL,
			  `codicerecupero` varchar(40) NOT NULL,
			  `skin` varchar(100) NOT NULL DEFAULT 'default',
			  `bio` text NOT NULL,
			  `avatar` varchar(100) NOT NULL,
			  `browsername` varchar(100) NOT NULL,
			  `browserversion` varchar(100) NOT NULL,
			  `platform` varchar(100) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `secret` (`secret`),
			  KEY `nickname` (`nickname`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}visitatori` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `ip` varchar(20) NOT NULL,
			  `lastaction` varchar(15) NOT NULL,
			  `giorno` varchar(10) NOT NULL,
			  `nickname` varchar(100) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}visite` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `minititolo` varchar(100) NOT NULL,
			  `nickname` varchar(100) NOT NULL,
			  `tipo` enum('pagine','news') NOT NULL DEFAULT 'pagine',
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`minititolo`,`nickname`,`tipo`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}voti` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `minititolo` varchar(100) NOT NULL,
			  `nickname` varchar(100) NOT NULL,
			  `tipo` enum('pagine','news') NOT NULL DEFAULT 'pagine',
			  `data` varchar(10) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `minititolo` (`minititolo`,`nickname`,`tipo`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;"
		);
		for($i=0, $count=count($array); $i<$count; ++$i)
			if(!$this->query($array[$i]))
				die(mysql_error());
	}
}
