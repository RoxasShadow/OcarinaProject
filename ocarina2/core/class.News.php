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
				if(!$query = parent::query("SELECT * FROM news WHERE minititolo='$minititolo' ORDER BY titolo ASC"))
					return false;
				array_push($news, parent::get($query));
				if(!empty($news))
					return $news;
				return false;
			}
			return false;
		}
		else {
			if(($min == '') && ($max == '')) {
				if(!$query = parent::query('SELECT * FROM news ORDER BY titolo ASC'))
					return false;
			}
			else {
				if(!$query = parent::query("SELECT * FROM news ORDER BY id DESC LIMIT $min, $max"))
					return false;
			}
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($news, $result);
				if(!empty($news))
					return $news;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se la news esiste. */
	public function isNews($minititolo) {
		if(!$query = parent::query("SELECT COUNT(*) FROM news WHERE minititolo='$minititolo' LIMIT 1"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quante news sono presenti nel database. */
	public function countNews() {
		if(!$query = parent::query('SELECT COUNT(*) FROM news'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le news da una keyword. */
	public function searchNews($keyword) {
		if(!$query = parent::query("SELECT * FROM news WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query))
				array_push($news, $result);
			if(!empty($news))
				return $news;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le news per categoria. */
	public function searchNewsByCategory($keyword) {
		if(!$query = parent::query("SELECT * FROM news WHERE categoria='$keyword' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query))
				array_push($news, $result);
			if(!empty($news))
				return $news;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le news per utente. */
	public function searchNewsByUser($nickname) {
		if(!$query = parent::query("SELECT * FROM news WHERE nickname='$nickname' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query))
				array_push($news, $result);
			if(!empty($news))
				return $news;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le news per approvazione. */
	public function searchNewsByApprovation() {
		if(!$query = parent::query("SELECT * FROM news WHERE approvato='0' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$news = array();
			while($result = parent::get($query))
				array_push($news, $result);
			if(!empty($news))
				return $news;
			return false;
		}
		else
			return false;
	}

	/* Crea una news. */
	public function createNews($array) {
		if(empty($array))
			return false;
		if((!$this->isNews($array[2])) && (parent::isCategory('news', $array[4])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM news ORDER BY id DESC LIMIT 1');
			if(!$campi = parent::getColumns($query))
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
	
	/* Crea una sitemap di tutte le news. */
	public function sitemapNews() {
		if(!$news = $this->getNews())
			return false;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($news as $v) {
			list($d, $m, $y) = ((isset($v->dataultimamodifica)) && ($v->dataultimamodifica !== '')) ? explode('-', $v->dataultimamodifica) : explode('-', $v->data);
			$sitemap .= "
	<url>
		<loc>{$this->config[0]->url_index}/news.php?titolo={$v->minititolo}</loc>
		<lastmod>20$y-$m-$d</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>";
		}
		$sitemap .= '
</urlset>';
		return $sitemap;
	}
	
	/* Crea un feed di X news. */
	public function feedNews($url, $min, $max) {
		if(!$news = $this->getNews('', $min, $max))
			return false;
		$feed = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="'.$url.'" rel="self" type="application/rss+xml" />
<title>'.$this->config[0]->nomesito.'</title>
<description>'.$this->config[0]->description.'</description>
<link>'.$this->config[0]->url_index.'/index.php</link>';
		foreach($news as $v) {
			list($d, $m, $y) = explode('-', $v->data);
			list($h, $mn, $s) = explode(':', $v->ora);
			$nickname = parent::getUser($v->autore);
			$feed .= "
	<item>
		<title>".htmlentities($v->titolo)."</title>
		<description>".parent::reduceLen(htmlentities($v->contenuto), 500, '...')."</description>
		<author>".htmlentities($nickname[0]->email)."(".htmlentities($v->autore).")</author>
		<category>".htmlentities($v->categoria)."</category>
		<pubDate>".str_replace('+0000', '+0200', date('r', mktime($h,$mn,$s,$m,$d,$y)))."</pubDate>
		<link>{$this->config[0]->url_index}/news.php?titolo={$v->minititolo}</link>
		<comments>{$this->config[0]->url_index}/news.php?titolo={$v->minititolo}</comments>
		<guid>{$this->config[0]->url_index}/news.php?titolo={$v->minititolo}</guid>
	</item>";
		}
		$feed .= '
</channel>
</rss>';
		return $feed;
	}
}
