<?php
/**
	core/class.Ad.php
	(C) Giovanni Capuano 2011
*/
require_once('class.User.php');

/* Questa classe permette di creare, modificare e cancellare gli annunci dell'amministrazion. */
class Ad extends User {

	/* Ottiene uno o più annunci. */
	public function getAd($minititolo = '') {
		$Ad = array();
		if($minititolo !== '') {
			if($this->isAd($minititolo)) {
				if(!$query = parent::query("SELECT * FROM {$this->prefix}annunci WHERE minititolo='$minititolo' ORDER BY id DESC"))
					return false;
				array_push($Ad, parent::get($query));
				if(!empty($Ad))
					return $Ad;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT * FROM '.$this->prefix.'annunci ORDER BY id DESC'))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($Ad, $result);
				if(!empty($Ad))
					return $Ad;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se l'annuncio esiste. */
	public function isAd($minititolo) {
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}annunci WHERE minititolo='$minititolo'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Crea un annuncio. */
	public function createAd($array) {
		if(empty($array))
			return false;
		if((!$this->isAd($array[2])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM '.$this->prefix.'annunci LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$query = 'INSERT INTO '.$this->prefix.'annunci(';
			foreach($campi as $var)
				if($var !== 'id')
					$query .= $var.', ';
			$query = trim($query, ', ');
			$query .= ') VALUES(';
			foreach($array as $var)
				$query .= "'$var', ";
			$query = trim($query, ', ');
			$query .= ')';
			return parent::query($query) ? true : false;
		}
		return false;
	}
	
	/* Modifica un annuncio. */
	public function editAd($campo, $valore, $minititolo) {
		return parent::query("UPDATE {$this->prefix}annunci SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una pagina. */
	public function deleteAd($minititolo) {
		return parent::query("DELETE FROM {$this->prefix}annunci WHERE minititolo='$minititolo'") ? true : false;
	}
}
