<?php
/**
	core/class.Comments.php
	(C) Giovanni Capuano 2011
*/
require_once('class.News.php');

/* Questa classe mette a disposizione dei metodi per gestire i commenti. */
class Comments extends News {

	/* Ottiene uno o più commenti. */
	public function getComment($news = '', $min = '', $max = '') {
		$commenti = array();
		if($news !== '') {
			if($this->isComment($news)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM commenti WHERE news='$news'"))
					return false;
				array_push($commenti, parent::get($query));
				if(is_array($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		else {
			if(($min == '') && ($max == '')) {
				if(!$query = parent::query('SELECT DISTINCT * FROM commenti'))
					return false;
			}
			else {
				if(!$query = parent::query("SELECT DISTINCT * FROM commenti LIMIT $min, $max"))
					return false;
			}
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($commenti, parent::get($query));
				if(is_array($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se il commento esiste. */
	public function isComment($news) {
		if(!$query = parent::query("SELECT * FROM commenti WHERE news='$news'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Ricerca i commenti da una keyword. */
	public function searchComment($keyword) {
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
		if((parent::isNews($array[2])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM commenti');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$query = 'INSERT INTO commenti(';
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
	
	/* Modifica un commento. */
	public function editComment($campo, $valore, $id) {
		if(!is_numeric($id))
			return false;
		return parent::query("UPDATE commenti SET $campo='$valore' WHERE id=$id") ? true : false;
	}
	
	/* Elimina un commento. */
	public function deleteComment($id) {
		if(!is_numeric($id))
			return false;
		return parent::query("DELETE FROM commenti WHERE id='$id'") ? true : false;
	}
}
