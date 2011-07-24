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
				if(!$query = parent::query("SELECT * FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1' ORDER BY id ASC"))
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
			if(!$query = parent::query('SELECT * FROM '.$this->prefix.'commenti WHERE approvato=\'1\' ORDER BY id ASC'))
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
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quanti commenti sono presenti nel database. */
	public function countComments() {
		if(!$query = parent::query('SELECT COUNT(*) FROM '.$this->prefix.'commenti WHERE approvato=\'1\''))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Conta quanti commenti collegati ad una news sono presenti nel database. */
	public function countCommentByNews($news) {
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1'"))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca i commenti da una keyword. */
	public function searchComment($keyword) {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}commenti WHERE contenuto LIKE '%$keyword%' AND approvato='1' ORDER BY id DESC"))
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
		if(!$query = parent::query("SELECT * FROM {$this->prefix}commenti WHERE id='$id' AND approvato='1'"))
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
	
	/* Ricerca i commenti per approvazione. */
	public function searchCommentByApprovation() {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}commenti WHERE approvato='0'"))
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
	
	/* Ricerca i commenti per utente. */
	public function searchCommentByUser($nickname) {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}commenti WHERE autore='$nickname' AND approvato='1'"))
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
			$query = parent::query('SELECT * FROM '.$this->prefix.'commenti WHERE approvato=\'1\' LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$query = 'INSERT INTO '.$this->prefix.'commenti(';
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
		return parent::query("UPDATE {$this->prefix}commenti SET $campo='$valore' WHERE id=$id") ? true : false;
	}
	
	/* Elimina un commento. */
	public function deleteComment($id) {
		if(!is_numeric($id))
			return false;
		return parent::query("DELETE FROM {$this->prefix}commenti WHERE id='$id'") ? true : false;
	}
	
	/* Elimina i commenti di un utente. */
	public function deleteCommentByUser($nickname) {
		$comments = $this->searchCommentByUser($nickname);
		if(!$comments)
			return false;
		foreach($comments as $v)
			$this->deleteComment($v->id);
		return true;
	}
	
	/* Crea una sitemap di tutti i commenti. */
	public function sitemapComment() {
		if(!$comment = $this->getComment())
			return false;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($comment as $v) {
			list($d, $m, $y) = explode('-', $v->data);
			$sitemap .= "
	<url>
		<loc>{$this->config[0]->url_index}/comment/{$v->id}.html</loc>
		<lastmod>20$y-$m-$d</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>";
		}
		$sitemap .= '
</urlset>';
		return $sitemap;
	}
}
