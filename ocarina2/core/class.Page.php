<?php
/**
	core/class.Page.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Category.php');

/* Questa classe mette a disposizione dei metodi per gestire le pagine. */
class Page extends Category {

	/* Ottiene una o più pagine. */
	public function getPage($minititolo = '') {
		$pagine = array();
		if($minititolo !== '') {
			if($this->isPage($minititolo)) {
				if(!$query = parent::query("SELECT * FROM pagine WHERE minititolo='$minititolo' ORDER BY titolo ASC"))
					return false;
				array_push($pagine, parent::get($query));
				if(!empty($pagine))
					return $pagine;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT * FROM pagine ORDER BY titolo ASC'))
				return false;
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
	
	/* Controlla se la pagina esiste. */
	public function isPage($minititolo) {
		if(!$query = parent::query("SELECT COUNT(*) FROM pagine WHERE minititolo='$minititolo'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quante pagine sono presenti nel database. */
	public function countPage() {
		if(!$query = parent::query('SELECT COUNT(*) FROM pagine'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Ricerca le pagine da una keyword. */
	public function searchPage($keyword, $orderById = '') {
		if($orderById !== '')
			$query = parent::query("SELECT * FROM pagine WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') ORDER BY id DESC");
		else
			$query = parent::query("SELECT * FROM pagine WHERE (titolo LIKE '%$keyword%') OR (contenuto LIKE '%$keyword%') ORDER BY titolo ASC");
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
		if(!$query = parent::query("SELECT * FROM pagine WHERE categoria='$keyword' ORDER BY id DESC"))
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
		if(!$query = parent::query("SELECT * FROM pagine WHERE nickname='$nickname' ORDER BY id DESC"))
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
		if(!$query = parent::query("SELECT * FROM pagine WHERE approvato='0' ORDER BY id DESC"))
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
			$query = parent::query('SELECT * FROM pagine LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$query = 'INSERT INTO pagine(';
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
	
	/* Modifica una pagina. */
	public function editPage($campo, $valore, $minititolo) {
		return parent::query("UPDATE pagine SET $campo='$valore' WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Elimina una pagina. */
	public function deletePage($minititolo) {
		return parent::query("DELETE FROM pagine WHERE minititolo='$minititolo'") ? true : false;
	}
	
	/* Crea una sitemap di tutte le pagine approvate. */
	public function sitemapPage() {
		if(!$page = $this->getPage())
			return false;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($page as $v) {
			list($d, $m, $y) = ((isset($v->dataultimamodifica)) && ($v->dataultimamodifica !== '')) ? explode('-', $v->dataultimamodifica) : explode('-', $v->data);
			$sitemap .= "
	<url>
		<loc>{$this->config[0]->url_index}/pagina.php?titolo={$v->minititolo}</loc>
		<lastmod>$y-$m-$d</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>";
		}
		$sitemap .= '
</urlset>';
		$f = fopen($this->config[0]->root_index.'/sitemap_page.xml', 'w');
		fwrite($f, $sitemap);
		fclose($f);
		return $sitemap;
	}
}
