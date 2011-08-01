<?php
/**
	core/class.News.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Category.php');

/* Questa classe mette a disposizione dei metodi per gestire le news. */
class News extends Category {

	/* Ottiene una o più news. */
	public function getNews($minititolo = '', $min = '', $max = '') {
		if($minititolo !== '')
			if($this->isNews($minititolo))
				return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE minititolo='$minititolo' AND approvato='1' LIMIT 1")) ? $result : false;
			else
				return false;
		else
			if(($min == '') && ($max == ''))
				return ($result = parent::get('SELECT * FROM '.$this->prefix.'news WHERE approvato=\'1\' ORDER BY titolo ASC')) ? $result : false;
			else
				return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE approvato='1' ORDER BY id DESC LIMIT $min, $max")) ? $result : false;
	}
	
	/* Permette di votare una news. */
	public function voteNews($minititolo) {
		if(parent::isLogged()) {
			$nickname = $this->username[0]->nickname;
			if(!$votanti = parent::query("SELECT COUNT(*) FROM {$this->prefix}voti WHERE minititolo='$minititolo' AND nickname='$nickname' AND tipo='news'"))
				return false;
			if(mysql_result($votanti, 0, 0) > 0)
				return false;
			$voti = (!$votanti = parent::query("SELECT COUNT(*) FROM {$this->prefix}voti WHERE minititolo='$minititolo' AND tipo='news'")) ? 1 : mysql_result($votanti, 0, 0) + 1;
			$data = date('d-m-y');
			if((parent::query("INSERT INTO {$this->prefix}voti(minititolo, nickname, tipo, data) VALUES('$minititolo', '$nickname', 'news', '$data')")) && (parent::query("UPDATE news SET voti='$voti' WHERE minititolo='$minititolo' AND approvato='1'")))
				return true;
		}
		return false;
	}
	
	/* Registra una visita in una news */
	public function addVisitNews($minititolo) {
		$visitatore = (parent::isLogged()) ? $this->username[0]->nickname : $_SERVER['REMOTE_ADDR'];
		if(!$visitatori = parent::query("SELECT COUNT(*) FROM {$this->prefix}visite WHERE minititolo='$minititolo' AND nickname='$visitatore' AND tipo='news' AND approvato='1'"))
			return false;
		if(mysql_result($visitatori, 0, 0) > 0)
			return false;
		if(!$visitatori = parent::query("SELECT COUNT(*) FROM {$this->prefix}visite WHERE minititolo='$minititolo' AND tipo='news' AND approvato='1'"))
			$visite = 1;
		else
			$visite = mysql_result($visitatori, 0, 0) + 1;
		if((parent::query("INSERT INTO {$this->prefix}visite(minititolo, nickname, tipo) VALUES('$minititolo', '$visitatore', 'news')")) && (parent::query("UPDATE news SET visite='$visite' WHERE minititolo='$minititolo' AND approvato='1'")))
				return true;
		return true;
	}
	
	/* Controlla se la news esiste. */
	public function isNews($minititolo) {
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}news WHERE minititolo='$minititolo' AND approvato='1' LIMIT 1"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quante news sono presenti nel database. */
	public function countNews() {
		if(!$query = parent::query('SELECT COUNT(*) FROM '.$this->prefix.'news WHERE approvato=\'1\''))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le news da una keyword. */
	public function searchNews($keyword) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') AND approvato='1' ORDER BY id DESC")) ? $result : false;
	}
	
	/* Ricerca le news per categoria. */
	public function searchNewsByCategory($keyword) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE categoria='$keyword' AND approvato='1' ORDER BY id DESC")) ? $result : false;
	}
	
	/* Ricerca le news per utente. */
	public function searchNewsByUser($nickname) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE autore='$nickname' AND approvato='1' ORDER BY id DESC")) ? $result : false;
	}
	
	/* Ricerca le news per approvazione. */
	public function searchNewsByApprovation() {
		return ($result = parent::get("SELECT * FROM {$this->prefix}news WHERE approvato='0' ORDER BY id DESC")) ? $result : false;
	}

	/* Crea una news. */
	public function createNews($array) {
		if(empty($array))
			return false;
		if((!$this->isNews($array[2])) && (parent::isCategory('news', $array[4])) && (parent::isUser($array[0]))) {
			if(!$campi = parent::getColumns('SELECT * FROM '.$this->prefix.'news WHERE approvato=\'1\' ORDER BY id DESC LIMIT 1'))
				return false;
			$query = 'INSERT INTO '.$this->prefix.'news(';
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
		return parent::query("UPDATE {$this->prefix}news SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una news. */
	public function deleteNews($minititolo) {
		return parent::query("DELETE FROM {$this->prefix}news WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina le news di un utente. */
	public function deleteNewsByUser($nickname) {
		if(!$news = $this->searchNewsByUser($nickname))
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
		<loc>{$this->config[0]->url_index}/news/{$v->minititolo}.html</loc>
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
		<link>{$this->config[0]->url_index}/news/{$v->minititolo}.html</link>
		<comments>{$this->config[0]->url_index}/news/{$v->minititolo}.html</comments>
		<guid>{$this->config[0]->url_index}/news/{$v->minititolo}.html</guid>
	</item>";
		}
		$feed .= '
</channel>
</rss>';
		return $feed;
	}
}
