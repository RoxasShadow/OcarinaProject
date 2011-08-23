<?php
/**
	core/class.Ad.php
	(C) Giovanni Capuano 2011
*/
require_once('class.PersonalMessage.php');

/* Questa classe permette di creare, modificare e cancellare gli annunci dell'amministrazione. */
class Ad extends PersonalMessage {

	/* Ottiene uno o più annunci. */
	public function getAd($minititolo = '') {
		if($minititolo !== '')
			if($this->isAd($minititolo))
				return ($result = parent::get("SELECT * FROM {$this->prefix}annunci WHERE minititolo='$minititolo' LIMIT 1")) ? $result : false;
			else
				return false;
		else
			return ($result = parent::get('SELECT * FROM '.$this->prefix.'annunci ORDER BY id DESC')) ? $result : false;
	}
	
	/* Controlla se l'annuncio esiste. */
	public function isAd($minititolo) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}annunci WHERE minititolo='$minititolo'") > 0 ? true : false;
	}
	
	/* Crea un annuncio. */
	public function createAd($array) {
		if(empty($array))
			return false;
		if((!$this->isAd($array[2])) && (parent::isUser($array[0]))) {
			if(!$campi = parent::getColumns('SELECT * FROM '.$this->prefix.'annunci LIMIT 1'))
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
