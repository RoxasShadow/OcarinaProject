<?php
/**
	core/class.MySQL.php
	(C) Giovanni Capuano 2011
*/
include 'class.Security.php';

/* Questa classe mette a disposizione dei metodi per gestire il database. */
class MySQL extends Security {
	private $host = 'localhost';
	private $username = 'root';
	private $password = 'kronos';
	private $database = 'ocarina2';
	private $connected;
	
	/* Quando la classe viene istanziata, il costruttore provvede a connettersi al database. */
	public function __construct() {
		$this->connect();
	}
	
	/* Quando la classe viene distrutta, il distruttore provvede a disconnettersi dal database. */
	public function __distruct() {
		$this->disconnect();
	}
	
	/* Esegue una connessione al database. */
	private function connect() {
		if(!$this->connected) {
			if(!$connessione = mysql_connect($this->host,$this->username,$this->password))
				return false;
			if(!mysql_selectdb($this->database, $connessione))
				return false;
			$this->connected = true;
		}
	}
	
	/* Esegue una disconnessione dal database. */
	private function disconnect() {
		if($this->connected) {
			if(!mysql_close())
				return false;
			$this->connected = false;
		}
	}

	/* Esegue una query. */
	public function query($query) {
		$result = mysql_query($query);
		return (!$result) ? false : $result;
	}

	/* Conta le occorrenze di una query. */
	public function count($query) {
		$result = mysql_num_rows($query);
		if(!$result)
			return 0;
		if($result <= 0)
			return 0;
		return $result;
	}
	
	/* Estrae un oggetto con dei record provenienti da una query. */
	public function get($query) {
		$result = mysql_fetch_object($query);
		return (!$result) ? false : $result;
	}
	
	/* Estrae un oggetto con dei record provenienti da una query. */
	public function getEnum($query) {
		$array = mysql_fetch_row($query);
		$category = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $array[1]));
		return (is_array($category)) ? $category : false;
	}
	
	/* Ritorna un array contenente le colonne di una tabella. */
	public function getColumns($query) {
		$array = array();
		$columns = mysql_num_fields($query);
		for($i=0; $i<$columns; $i++)
			$array[$i] = mysql_field_name($query, $i);
		return $array;
	}
}
