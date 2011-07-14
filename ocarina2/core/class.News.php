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
					if(parent::isLogged()) {
						$visitatori = explode('|||', $news[0]->visitatori);
						if(!in_array($_SERVER['REMOTE_ADDR'], $visitatori)) {
							if((!isset($news[0]->visitatori)) || ($news[0]->visitatori == ''))
								$visitatori = $_SERVER['REMOTE_ADDR'];
							else
								$visitatori = $news[0]->visitatori.'|||'.$_SERVER['REMOTE_ADDR'];
							if((!isset($news[0]->visite)) || ($news[0]->visite == ''))
								$visite = 1;
							else
								$visite = $news[0]->visite += 1;
							$this->editNews('visite', $visite, $news[0]->minititolo);
							$this->editNews('visitatori', $visitatori, $news[0]->minititolo);
						}
					}
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
	
	/* Permette di votare una news. */
	public function voteNews($minititolo) {
		if(parent::isLogged()) {
			if(!$news = $this->getNews($minititolo))
				return false;
			$votanti = explode('|||', $news[0]->votanti);
			if(!in_array($this->username[0]->nickname, $votanti)) {
				if((!isset($news[0]->votanti)) || ($news[0]->votanti == ''))
					$votanti = $this->username[0]->nickname;
				else
					$votanti = $news[0]->votanti.'|||'.$this->username[0]->nickname;
				if((!isset($news[0]->voti)) || ($news[0]->voti == ''))
					$voti = 1;
				else
					$voti = $news[0]->voti += 1;
				if(($this->editNews('voti', $voti, $minititolo)) && ($this->editNews('votanti', $votanti, $minititolo)))
					return true;
				return false;
			}
		}
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
		if(!$query = parent::query("SELECT * FROM news WHERE autore='$nickname' ORDER BY id DESC"))
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
				if(($var !== 'id') && ($var !== 'dataultimamodifica') && ($var !== 'oraultimamodifica') && ($var !== 'autoreultimamodifica') && ($var !== 'visite') && ($var !== 'visitatori') && ($var !== 'voti') && ($var !== 'votanti'))
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
	
	/* Elimina le news di un utente. */
	public function deleteNewsByUser($nickname) {
		$news = $this->searchNewsByUser($nickname);
		if(!$news)
			return false;
		foreach($news as $v)
			$this->deleteNews($v->minititolo);
		return true;
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
		<title>".parent::xmlentities(htmlentities($v->titolo))."</title>
		<description>".parent::xmlentities(htmlentities($v->contenuto))."</description>
		<author>".parent::xmlentities(htmlentities($nickname[0]->email)).'('.parent::xmlentities(htmlentities($v->autore)).")</author>
		<category>".parent::xmlentities(htmlentities($v->categoria))."</category>
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
