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
			if(!$connessione = mysql_connect($this->host,$this->username,$this->password))
				return false;
			if(!mysql_selectdb($this->database, $connessione))
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
}
