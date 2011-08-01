<?php
/**
	core/class.Category.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Ad.php');

/* Questa classe mette a disposizione dei metodi per gestire le categorie. */
class Category extends Ad {

	/* Ottengo le categorie. */
	public function getCategory($campo) {
		return ($array = parent::getEnum("SHOW COLUMNS FROM {$this->prefix}$campo LIKE 'categoria'")) ? $array : false;
	}
	
	/* Controlla se una categoria esiste. */
	public function isCategory($campo, $categoria) {
		if(!$array = parent::getEnum("SHOW COLUMNS FROM {$this->prefix}$campo LIKE 'categoria'"))
			return false;
		foreach($array as $var)
			if($var == $categoria)
				return true;
		return false;
	}
	
	/* Crea una categoria. */
	public function createCategory($campo, $categoria) {
		if(!$this->isCategory($campo, $categoria)) {
			if(!$result = $this->getCategory($campo))
				return false;
			$result[count($result)+1] = $categoria;
			$query = "ALTER TABLE {$this->prefix}$campo CHANGE categoria categoria ENUM(";
			foreach($result as $var) {
				$query .= "'$var', ";
			}
			$query = trim($query, ', ');
			$query .= ')';
			return (!parent::query($query)) ? false : true;
		}
		return false;
	}
	
	/* Elimina una categoria. */
	public function deleteCategory($campo, $categoria) {
		if($this->isCategory($campo, $categoria)) {
			if(!$result = $this->getCategory($campo))
				return false;
			$result[count($result)+1] = $categoria;
			$query = "ALTER TABLE {$this->prefix}$campo CHANGE categoria categoria ENUM(";
			foreach($result as $var) {
				if($var !== $categoria)
					$query .= "'$var', ";
			}
			$query = trim($query, ', ');
			$query .= ')';
			return (!parent::query($query)) ? false : true;
		}
		return false;
	}
}
