<?php
/**
	core/class.Comments.php
	(C) Giovanni Capuano 2011
*/
include 'class.News.php';

/* Questa classe mette a disposizione dei metodi per gestire i commenti. */
class Comments extends News {

	/* Ottiene uno o più commenti. */
	public function getPage($id = '') {
		$commenti = array();
		if($id !== '') {
			if(!is_numeric($id))
				return false;
			if($this->isComment($id)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM commenti WHERE id='$id'"))
					return false;
				array_push($commenti, parent::get($query));
				if(is_array($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query("SELECT DISTINCT * FROM commenti"))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($commenti, $result);
				if(is_array($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se il commento esiste. */
	public function isComment($id) {
		if(!$query = parent::query("SELECT * FROM commenti WHERE id='$id'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Ricerca i commenti per contenuto. */
	public function searchCommentByContent($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM commenti WHERE contenuto LIKE '%$keyword%'"))
			return false;
		if(parent::count($query) > 0) {
			$commenti = array();
			while($result = parent::get($query)) {
				array_push($commenti, $result);
			}
			if(is_array($commenti))
				return $commenti;
			return false;
		}
		else
			return false;
	}
	
	/* Crea un commento. */
	public function createComment($array) {
		if(!is_array($array))
			return false;
		if((parent::isNews($array[0])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM commenti');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$query = 'INSERT INTO commenti(';
			foreach($campi as $var)
				if(($var !== 'id')
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
	
	/* Modifica un commento. */
	public function editComment($campo, $valore, $id) {
		return parent::query("UPDATE comenti SET $campo='$valore' WHERE id='$id'") ? true : false;
	}
	
	/* Elimina un commento. */
	public function deleteComment($id) {
		return parent::query("DELETE FROM commenti WHERE id='$id'")) ? true : false
	}
}
