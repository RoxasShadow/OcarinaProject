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
		if($news !== '')
			if($this->isComment($news))
				return ($result = parent::get("SELECT * FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1'")) ? $result : false;
			else
				return false;
		else
			return ($result = parent::get('SELECT * FROM '.$this->prefix.'commenti WHERE approvato=\'1\' ORDER BY id ASC')) ? $result : false;
	}
	
	/* Controlla se il commento esiste. */
	public function isComment($news) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1'") > 0 ? true : false;
	}
	
	/* Conta quanti commenti sono presenti nel database. */
	public function countComments() {
		return parent::resultCountQuery('SELECT COUNT(*) FROM '.$this->prefix.'commenti WHERE approvato=\'1\'');
	}
	
	/* Conta quanti commenti collegati ad una news sono presenti nel database. */
	public function countCommentByNews($news) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}commenti WHERE news='$news' AND approvato='1'");
	}
	
	/* Ricerca i commenti da una keyword. */
	public function searchComment($keyword) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}commenti WHERE contenuto LIKE '%$keyword%' AND approvato='1' ORDER BY id DESC")) ? $result : false;
	}
	
	/* Ricerca il commento da un id. */
	public function searchCommentById($id) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}commenti WHERE id='$id' AND approvato='1'")) ? $result : false;
	}
	
	/* Ricerca i commenti per approvazione. */
	public function searchCommentByApprovation() {
		return ($result = parent::get("SELECT * FROM {$this->prefix}commenti WHERE approvato='0'")) ? $result : false;
	}
	
	/* Ricerca i commenti per utente. */
	public function searchCommentByUser($nickname) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}commenti WHERE autore='$nickname' AND approvato='1'")) ? $result : false;
	}
	
	/* Crea un commento. */
	public function createComment($array) {
		if(empty($array))
			return false;
		if((parent::isNews($array[2])) && (parent::isUser($array[0]))) {
			$query = 'INSERT INTO '.$this->prefix.'commenti(autore, contenuto, news, data, ora, approvato) VALUES(';
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
		if(!$comments = $this->searchCommentByUser($nickname))
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
