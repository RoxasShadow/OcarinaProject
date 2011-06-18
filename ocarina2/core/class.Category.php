<?php
/**
	core/class.Category.php
	(C) Giovanni Capuano 2011
*/
require_once('class.User.php');

/* Questa classe mette a disposizione dei metodi per gestire le categorie. */
class Category extends User {

	/* Ottengo le categorie. */
	public function getCategory($campo) {
		if(!$query = parent::query("SHOW COLUMNS FROM $campo LIKE 'categoria'"))
			return false;
		if(!$array = parent::getEnum($query))
			return false;
		return $array;
	}
	
	/* Controlla se una categoria esiste. */
	public function isCategory($campo, $categoria) {
		if(!$query = parent::query("SHOW COLUMNS FROM $campo LIKE 'categoria'"))
			return false;
		if(!$array = parent::getEnum($query))
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
			$query = "ALTER TABLE $campo CHANGE categoria categoria ENUM(";
			foreach($result as $var) {
					$query .= "'$var', ";
			}
			$query = trim($query, ', ');
			$query .= ')';
			if(!parent::query($query))
				return false;
			return true;
		}
		return false;
	}
	
	/* Elimina una categoria. */
	public function deleteCategory($campo, $categoria) {
		if($this->isCategory($campo, $categoria)) {
			if(!$result = $this->getCategory($campo))
				return false;
			$result[count($result)+1] = $categoria;
			$query = "ALTER TABLE $campo CHANGE categoria categoria ENUM(";
			foreach($result as $var) {
				if($var !== $categoria)
					$query .= "'$var', ";
			}
			$query = trim($query, ', ');
			$query .= ')';
			if(!parent::query($query))
				return false;
			return true;
		}
		return false;
	}
}
