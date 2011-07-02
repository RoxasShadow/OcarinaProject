<?php
/**
	core/class.Comments.php
	(C) Giovanni Capuano 2011
*/
require_once('class.News.php');

/* Questa classe mette a disposizione dei metodi per gestire i commenti. */
class Comments extends News {

	/* Ottiene uno o più commenti. */
	public function getComment($news = '') {
		$commenti = array();
		if($news !== '') {
			if($this->isComment($news)) {
				if(!$query = parent::query("SELECT * FROM commenti WHERE news='$news' ORDER BY id ASC"))
					return false;
				while($result = parent::get($query))
					array_push($commenti, $result);
				if(!empty($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT * FROM commenti ORDER BY id ASC'))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($commenti, $result);
				if(!empty($commenti))
					return $commenti;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se il commento esiste. */
	public function isComment($news) {
		if(!$query = parent::query("SELECT id FROM commenti WHERE news='$news' LIMIT 1"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Conta quanti commenti sono presenti nel database. */
	public function countNews() {
		if(!$query = parent::query('SELECT COUNT(*) FROM commenti'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Conta quanti commenti collegati ad una news sono presenti nel database. */
	public function countCommentByNews($news) {
		if(!$query = parent::query("SELECT COUNT(*) FROM commenti WHERE news='$news'"))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca i commenti da una keyword. */
	public function searchComment($keyword) {
		if(!$query = parent::query("SELECT * FROM commenti WHERE contenuto LIKE '%$keyword%' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$commenti = array();
			while($result = parent::get($query)) {
				array_push($commenti, $result);
			}
			if(!empty($commenti))
				return $commenti;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca il commento da un id. */
	public function searchCommentById($id) {
		if(!$query = parent::query("SELECT * FROM commenti WHERE id='$id'"))
			return false;
		if(parent::count($query) > 0) {
			$commenti = array();
			while($result = parent::get($query)) {
				array_push($commenti, $result);
			}
			if(!empty($commenti))
				return $commenti;
			return false;
		}
		else
			return false;
	}
	
	/* Crea un commento. */
	public function createComment($array) {
		if(empty($array))
			return false;
		if((parent::isNews($array[2])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM commenti LIMIT 1');
			if(!$campi = parent::getColumns($query))
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
