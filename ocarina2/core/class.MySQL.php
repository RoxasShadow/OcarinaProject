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
	private $password = 'password';
	private $database = 'ocarina2';
	private $connected;
	public $numQuery = 0;
	public $prefix = '';
	
	/* Quando la classe viene istanziata, il costruttore provvede a connettersi al database. */
	public function __construct() {
		$this->connect();
	}
	
	/* Quando la classe viene distrutta, il distruttore provvede a disconnettersi dal database. */
	public function __distruct() {
		$this->disconnect();
	}
	
	/* Esegue una connessione al database. */
	protected function connect() {
		if(!$this->connected) {
			if(!mysql_selectdb($this->database, mysql_connect($this->host,$this->username,$this->password)))
				return false;
			$this->connected = true;
		}
	}
	
	/* Esegue una disconnessione dal database. */
	protected function disconnect() {
		if($this->connected) {
			if(!mysql_close())
				return false;
			$this->connected = false;
		}
	}

	/* Esegue una query. */
	protected function query($query) {
		$result = mysql_query($query);
		if(!$result)
			return false;
		$this->numQuery++;
		return $result;
	}

	/* Conta le occorrenze di una query. */
	protected function count($query) {
		$result = mysql_num_rows($query);
		if(!$result)
			return 0;
		if($result <= 0)
			return 0;
		return $result;
	}
	
	/* Estrae un oggetto con dei record provenienti da una query. */
	protected function get($query) {
		$result = mysql_fetch_object($query);
		return (!$result) ? false : $result;
	}
	
	/* Estrae un oggetto con dei record provenienti da una query. */
	protected function getEnum($query) {
		$array = mysql_fetch_row($query);
		$category = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $array[1]));
		return (!empty($category)) ? $category : false;
	}
	
	/* Ritorna un array contenente le colonne di una tabella. */
	protected function getColumns($query) {
		$array = array();
		$columns = mysql_num_fields($query);
		for($i=0; $i<$columns; $i++)
			$array[$i] = mysql_field_name($query, $i);
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
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

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
			  `categoria` enum('Senza categoria') DEFAULT 'Senza categoria',
			  `data` varchar(10) NOT NULL,
			  `ora` varchar(10) NOT NULL,
			  `dataultimamodifica` varchar(10) NOT NULL,
			  `oraultimamodifica` varchar(10) NOT NULL,
			  `autoreultimamodifica` varchar(100) NOT NULL,
			  `approvato` tinyint(1) NOT NULL,
			  `voti` int(100) NOT NULL,
			  `visite` int(100) NOT NULL,
			  PRIMARY KEY (`id`)
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
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}utenti` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `nickname` varchar(100) NOT NULL,
			  `password` varchar(40) NOT NULL,
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
			  PRIMARY KEY (`id`)
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
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",

			"CREATE TABLE IF NOT EXISTS `{$this->prefix}voti` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `minititolo` varchar(100) NOT NULL,
			  `nickname` varchar(100) NOT NULL,
			  `tipo` enum('pagine','news') NOT NULL DEFAULT 'pagine',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1;",
		);
		for($i=0, $count=count($array); $i<$count; ++$i)
			$this->query($array[$i]) or die(mysql_error());
	}
}
