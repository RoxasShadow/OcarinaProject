<?php
/**
	core/class.Configuration.php
	(C) Giovanni Capuano 2011
*/
require_once('class.MySQL.php');

/* Questa classe mette a disposizione dei metodi per gestire la configurazione. */
class Configuration extends MySQL {
	public $config = NULL;		
	
	public function __construct() {
		parent::__construct();
		$this->config = $this->getConfig();
	}

	/* Ottengo un oggetto contenente la configurazione. */
	public function getConfig($campo = '') {
		if($campo !== '')
			return ($result = parent::get("SELECT $campo FROM {$this->prefix}configurazione LIMIT 1")) ? $result : false;
		else
			return ($result = parent::get('SELECT * FROM '.$this->prefix.'configurazione LIMIT 1')) ? $result : false;
	}
	
	/* Creo una nuova configurazione. */
	public function createConfig($config) {
		if(empty($config))
			return false;
		if(!$campi = parent::getColumns('SELECT * FROM '.$this->prefix.'configurazione LIMIT 1'))
			return false;
		$query = 'INSERT INTO '.$this->prefix.'configurazione(';
		foreach($campi as $var)
			if($var !== 'id')
				$query .= $var.', ';
		$query = trim($query, ', ');
		$query .= ') VALUES(';
		foreach($config as $var)
			$query .= "'$var', ";
		$query = trim($query, ', ');
		$query .= ')';
		return parent::query($query) ? true : false;
	}
	
	/* Modifica una configurazione. */
	public function editConfig($campo, $valore) {
		return parent::query("UPDATE {$this->prefix}configurazione SET $campo='$valore'") ? true : false;
	}
}
