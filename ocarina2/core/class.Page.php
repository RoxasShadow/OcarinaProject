<?php
/**
	core/class.Page.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Category.php');

/* Questa classe mette a disposizione dei metodi per gestire le pagine. */
class Page extends Category {

	/* Ottiene una o più pagine. */
	public function getPage($minititolo = '', $min = '', $max = '') {
		$pagine = array();
		if($minititolo !== '') {
			if($this->isPage($minititolo)) {
				if(!$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE minititolo='$minititolo' AND approvato='1' ORDER BY titolo ASC"))
					return false;
				array_push($pagine, parent::get($query));
				if(!empty($pagine))  {
					$this->addVisitPage($minititolo);
					return $pagine;
				}
				return false;
			}
			return false;
		}
		else {
			if(($min == '') && ($max == '')) {
				if(!$query = parent::query('SELECT * FROM '.$this->prefix.'pagine WHERE approvato=\'1\' ORDER BY titolo ASC'))
					return false;
			}
			else {
				if(!$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE approvato='1' ORDER BY titolo ASC LIMIT $min, $max"))
					return false;
			}
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($pagine, $result);
				if(!empty($pagine))
					return $pagine;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Permette di votare una pagina. */
	public function votePage($minititolo) {
		if(parent::isLogged()) {
			$nickname = $this->username[0]->nickname;
			if(!$votanti = parent::query("SELECT COUNT(*) FROM {$this->prefix}voti WHERE minititolo='$minititolo' AND nickname='$nickname' AND tipo='pagine'"))
				return false;
			if(mysql_result($votanti, 0, 0) > 0)
				return false;
			$voti = (!$votanti = parent::query("SELECT COUNT(*) FROM {$this->prefix}voti WHERE minititolo='$minititolo' AND tipo='pagine'")) ? 1 : mysql_result($votanti, 0, 0) + 1;
			$data = date('d-m-y');
			if((parent::query("INSERT INTO {$this->prefix}voti(minititolo, nickname, tipo, data) VALUES('$minititolo', '$nickname', 'pagine', '$news')")) && (parent::query("UPDATE pagine SET voti='$voti' WHERE minititolo='$minititolo' AND approvato='1'")))
				return true;
		}
		return false;
	}
	
	/* Registra una visita in una pagina */
	public function addVisitPage($minititolo) {
		$visitatore = (parent::isLogged()) ? $this->username[0]->nickname : $_SERVER['REMOTE_ADDR'];
		if(!$visitatori = parent::query("SELECT COUNT(*) FROM {$this->prefix}visite WHERE minititolo='$minititolo' AND nickname='$visitatore' AND tipo='pagine' AND approvato='1'"))
			return false;
		if(mysql_result($visitatori, 0, 0) > 0)
			return false;
		if(!$visitatori = parent::query("SELECT COUNT(*) FROM {$this->prefix}visite WHERE minititolo='$minititolo' AND tipo='pagine' AND approvato='1'"))
			$visite = 1;
		else
			$visite = mysql_result($visitatori, 0, 0) + 1;
		if((parent::query("INSERT INTO {$this->prefix}visite(minititolo, nickname, tipo) VALUES('$minititolo', '$visitatore', 'pagine')")) && (parent::query("UPDATE pagine SET visite='$visite' WHERE minititolo='$minititolo' AND approvato='1'")))
				return true;
		return true;
	}
	
	/* Controlla se la pagina esiste. */
	public function isPage($minititolo) {
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}pagine WHERE minititolo='$minititolo' AND approvato='1'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quante pagine sono presenti nel database. */
	public function countPage() {
		if(!$query = parent::query('SELECT COUNT(*) FROM '.$this->prefix.'pagine WHERE approvato=\'1\''))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le pagine da una keyword. */
	public function searchPage($keyword, $orderById = '') {
		if($orderById !== '')
			$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') AND approvato='1' ORDER BY id DESC");
		else
			$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') AND approvato='1' ORDER BY titolo ASC");
		if(!$query)
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query))
				array_push($pagine, $result);
			if(!empty($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le pagine per categoria. */
	public function searchPageByCategory($keyword) {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE categoria='$keyword' AND approvato='1' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query))
				array_push($pagine, $result);
			if(!empty($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le pagine per utente. */
	public function searchPageByUser($nickname) {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE autore='$nickname' AND approvato='1' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query))
				array_push($pagine, $result);
			if(!empty($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Ricerca le pagine per approvazione. */
	public function searchPageByApprovation() {
		if(!$query = parent::query("SELECT * FROM {$this->prefix}pagine WHERE approvato='0' ORDER BY id DESC"))
			return false;
		if(parent::count($query) > 0) {
			$pagine = array();
			while($result = parent::get($query))
				array_push($pagine, $result);
			if(!empty($pagine))
				return $pagine;
			return false;
		}
		else
			return false;
	}
	
	/* Crea una pagina. */
	public function createPage($array) {
		if(empty($array))
			return false;
		if((!$this->isPage($array[2])) && (parent::isCategory('pagine', $array[4])) && (parent::isUser($array[0]))) {
			$query = parent::query('SELECT * FROM '.$this->prefix.'pagine WHERE approvato=\'1\' LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$query = 'INSERT INTO '.$this->prefix.'pagine(';
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
	
	/* Modifica una pagina. */
	public function editPage($campo, $valore, $minititolo) {
		return parent::query("UPDATE {$this->prefix}pagine SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una pagina. */
	public function deletePage($minititolo) {
		return parent::query("DELETE FROM {$this->prefix}pagine WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina le pagine di un utente. */
	public function deletePageByUser($nickname) {
		if(!$page = $this->searchPageByUser($nickname))
			return false;
		foreach($page as $v)
			$this->deletePage($v->minititolo);
		return true;
	}
	
	/* Crea una sitemap di tutte le pagine. */
	public function sitemapPage() {
		if(!$page = $this->getPage())
			return false;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($page as $v) {
			list($d, $m, $y) = ((isset($v->dataultimamodifica)) && ($v->dataultimamodifica !== '')) ? explode('-', $v->dataultimamodifica) : explode('-', $v->data);
			$sitemap .= "
	<url>
		<loc>{$this->config[0]->url_index}/page/{$v->minititolo}.html</loc>
		<lastmod>20$y-$m-$d</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>";
		}
		$sitemap .= '
</urlset>';
		return $sitemap;
	}
	
	/* Crea un feed di X pagine. */
	public function feedPage($url, $min, $max) {
		if(!$page = $this->getPage('', $min, $max))
			return false;
		$feed = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="'.$url.'" rel="self" type="application/rss+xml" />
<title>'.$this->config[0]->nomesito.'</title>
<description>'.$this->config[0]->description.'</description>
<link>'.$this->config[0]->url_index.'/index.php</link>';
		foreach($page as $v) {
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
		<link>{$this->config[0]->url_index}/pagina/{$v->minititolo}.html</link>
		<comments>{$this->config[0]->url_index}/pagina/{$v->minititolo}.html</comments>
		<guid>{$this->config[0]->url_index}/pagina/{$v->minititolo}.html</guid>
	</item>";
		}
		$feed .= '
</channel>
</rss>';
		return $feed;
	}
}
