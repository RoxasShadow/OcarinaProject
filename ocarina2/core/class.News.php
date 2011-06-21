<?php
/**
	core/class.News.phpz
	(C) Giovanni Capuano 2011
*/
require_once('class.Category.php');

/* Questa classe mette a disposizione dei metodi per gestire le news. */
class News extends Category {

	/* Ottiene una o più news. */
	public function getNews($minititolo = '', $min = '', $max = '') {
		$news = array();
		if($minititolo !== '') {
			if($this->isNews($minititolo)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE minititolo='$minititolo' ORDER BY titolo ASC"))
					return false;
				array_push($news, parent::get($query));
				if(is_array($news))
					return $news;
				return false;
			}
			return false;
		}
		else {
			if(($min == '') && ($max == '')) {
				if(!$query = parent::query('SELECT DISTINCT * FROM news ORDER BY titolo ASC'))
					return false;
			}
			else {
				if(!$query = parent::query("SELECT DISTINCT * FROM news ORDER BY id DESC LIMIT $min, $max"))
					return false;
			}
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($news, $result);
				if(is_array($news))
					return $news;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se la news esiste. */
	public function isNews($minititolo) {
		if(!$query = parent::query("SELECT * FROM news WHERE minititolo='$minititolo'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Conta quante news sono presenti nel database. */
	public function countNews() {
		if(!$query = parent::query('SELECT COUNT(*) FROM news'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le news da una keyword. */
	public function searchNews($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query)) {
				array_push($news, $result);
			}
			if(is_array($news))
				return $news;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le news per categoria. */
	public function searchNewsByCategory($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE categoria='$keyword' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query)) {
				array_push($news, $result);
			}
			if(is_array($news))
				return $news;
			return false;
		}
		else
			return false;
	}
	
	/* Crea una news. */
	public function createNews($array) {
		if(!is_array($array))
			return false;
		if((!$this->isNews($array[2])) && (parent::isCategory('news', $array[4])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM news ORDER BY id DESC');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$query = 'INSERT INTO news(';
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
	
	/* Modifica una news. */
	public function editNews($campo, $valore, $minititolo) {
		return parent::query("UPDATE news SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una news. */
	public function deleteNews($minititolo) {
		return parent::query("DELETE FROM news WHERE minititolo='$minititolo'") ? true : false;
	}
}
