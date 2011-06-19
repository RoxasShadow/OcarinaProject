<?php
/**
	core/class.Page.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Category.php');

/* Questa classe mette a disposizione dei metodi per gestire le pagine. */
class Page extends Category {

	/* Ottiene una o più pagine. */
	public function getPage($minititolo = '') {
		$pagine = array();
		if($minititolo !== '') {
			if($this->isPage($minititolo)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM pagine WHERE minititolo='$minititolo'"))
					return false;
				array_push($pagine, parent::get($query));
				if(is_array($pagine))
					return $pagine;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT DISTINCT * FROM pagine'))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($pagine, $result);
				if(is_array($pagine))
					return $pagine;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se la pagina esiste. */
	public function isPage($minititolo) {
		if(!$query = parent::query("SELECT * FROM pagine WHERE minititolo='$minititolo'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Conta quante pagine sono presenti nel database. */
	public function countPage() {
		if(!$query = parent::query('SELECT COUNT(*) FROM pagine'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le pagine per titolo.
	public function searchPageByTitle($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM pagine WHERE titolo LIKE '%$keyword%'"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query)) {
				array_push($pagine, $result);
			}
			if(is_array($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le pagine per contenuto.
	public function searchPageByContent($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM pagine WHERE contenuto LIKE '%$keyword%'"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query)) {
				array_push($pagine, $result);
			}
			if(is_array($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}*/
	
	/* Ricerca le pagine da una keyword. */
	public function searchPage($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM pagine WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%')"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query)) {
				array_push($pagine, $result);
			}
			if(is_array($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le pagine per categoria. */
	public function searchPageByCategory($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM pagine WHERE categoria='$keyword'"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query)) {
				array_push($pagine, $result);
			}
			if(is_array($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Crea una pagina. */
	public function createPage($array) {
		if(!is_array($array))
			return false;
		if((!$this->isPage($array[2])) && (parent::isCategory('pagine', $array[4])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM pagine');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$query = 'INSERT INTO pagine(';
			foreach($campi as $var)
				if(($var !== 'id') && ($var !== 'dataultimamodifica') && ($var !== 'oraultimamodifica') && ($var !== 'autoreultimamodifica'))
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
	
	/* Modifica una pagina. */
	public function editPage($campo, $valore, $minititolo) {
		return parent::query("UPDATE pagine SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una pagina. */
	public function deletePage($minititolo) {
		return parent::query("DELETE FROM pagine WHERE minititolo='$minititolo'") ? true : false;
	}
}
