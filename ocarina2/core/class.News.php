<?php
/**
	core/class.News.php
	(C) Giovanni Capuano 2011
*/
include 'class.Category.php';

/* Questa classe mette a disposizione dei metodi per gestire le news. */
class News extends Category {

	/* Ottiene una o più news. */
	public function getNews($minititolo = '') {
		$news = array();
		if($minititolo !== '') {
			if($this->isPage($minititolo)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE minititolo='$minititolo'"))
					return false;
				array_push($news, parent::get($query));
				if(is_array($news))
					return $news;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query("SELECT DISTINCT * FROM news"))
				return false;
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
	
	/* Ricerca le news per titolo. */
	public function searchNewsByTitle($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE titolo LIKE '%$keyword%'"))
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
	
	/* Ricerca le news per contenuto. */
	public function searchNewsByContent($keyword) {
		if(!$query = parent::query("SELECT DISTINCT * FROM news WHERE contenuto LIKE '%$keyword%'"))
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
			$query = parent::query('SELECT * FROM news');
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
