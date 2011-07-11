<?php
/**
	core/class.User.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Configuration.php');

/* Questa classe mette a disposizione dei metodi per gestire gli utenti. */
class User extends Configuration {
	public $logged = NULL;
	public $username = NULL;
	
	public function __construct() {
		parent::__construct();
		$this->logged = $this->isLogged();
		$this->username = $this->logged ? $this->searchUserByField('secret', $this->getCookie()) : false;
	}

	/* Ottiene uno o più utenti. */
	public function getUser($nickname = '') {
		$utenti = array();
		if($nickname !== '') {
			if($this->isUser($nickname)) {
				if(!$query = parent::query("SELECT * FROM utenti WHERE nickname='$nickname' LIMIT 1"))
					return false;
				array_push($utenti, parent::get($query));
				if(!empty($utenti))
					return $utenti;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT * FROM utenti ORDER BY nickname ASC'))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($utenti, $result);
				if(!empty($utenti))
					return $utenti;
				return false;
			}
			return false;
		}
		return false;
	}

	/* Ottiene i visitatori. */
	public function getVisitator() {
		$visitatori = array();
		if(!$query = parent::query('SELECT * FROM visitatori ORDER BY id ASC'))
			return false;
		if(parent::count($query) > 0) {
			while($result = parent::get($query))
				array_push($visitatori, $result);
			if(!empty($visitatori))
				return $visitatori;
			return false;
		}
		return false;
	}
	
	/* Controlla se l'utente esiste. */
	public function isUser($nickname) {
		if(!$query = parent::query("SELECT COUNT(*) FROM utenti WHERE nickname='$nickname'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Controlla se l'email è già usata da un altro utente. */
	public function isEmailUsed($nickname, $email) {
		if(!$query = parent::query("SELECT COUNT(*) FROM utenti WHERE email='$email' AND nickname<>'$nickname'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quanti utenti sono presenti nel database. */
	public function countUser() {
		if(!$query = parent::query('SELECT COUNT(*) FROM utenti'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Controlla se l'utente è loggato. */
	public function isLogged() {
		$cookie = $this->getCookie();
		if(!$cookie) {
			$this->newVisitator();
			return false;
		}
		if(!$query = parent::query("SELECT COUNT(*) FROM utenti WHERE secret='$cookie'")) {
			$this->newVisitator();
			return false;
		}
		$logged = mysql_result($query, 0, 0) > 0 ? true : false;
		if(($logged) && (is_array($this->username)))
			$this->editUser('lastaction', time(), $this->username[0]->nickname);
		else
			$this->newVisitator();
		return $logged;
	}
	
	/* Ritorna la lista di utenti online. */
	public function getUserOnline() {
		$data = time();
		$user = $this->getUser();
		$userOnline = array();
		foreach($user as $v)
			if(($data - $v->lastaction) <= 60*5) // 5 minuti
				$userOnline[] = $v->nickname;
		return $userOnline;
	}
	
	/* Ritorna il numero di visitatori online. */
	public function getVisitatorOnline() {
		$data = time();
		if(!$visitator = $this->getVisitator())
			return 0;
		$visitatorOnline = 0;
		foreach($visitator as $v)
			if(($data - $v->lastaction) <= 60*5) // 5 minuti
				++$visitatorOnline;
		return $visitatorOnline;
	}
	
	/* Ricerca gli utenti per un campo specifico. */
	public function searchUserByField($campo, $valore) {
		if(!$query = parent::query("SELECT * FROM utenti WHERE $campo='$valore' ORDER BY nickname ASC"))
			return false;
		if(parent::count($query) > 0) {
			$utenti = array();
			while($result = parent::get($query))
				array_push($utenti, $result);
			array_push($utenti, parent::get($query));
			if(!empty($utenti))
				return $utenti;
			return false;
		}
		else
			return false;
	}
	
	/* Crea un commento. */
	public function createUser($array) {
		if(empty($array))
			return false;
		if((!$this->isUser($array[0])) && (parent::isEmail($array[2]))) {
			$query = parent::query('SELECT * FROM utenti LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$array[1] = md5($array[1]);
			$query = 'INSERT INTO utenti(';
			foreach($campi as $var)
				if(($var !== 'id') && ($var !== 'secret') && ($var !== 'bio') && ($var !== 'avatar') && ($var !== 'lastlogout') && ($var !== 'ip') && ($var !== 'browsername') && ($var !== 'browserversion') && ($var !== 'platform') && ($var !== 'codicerecupero'))
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
	
	/* Modifica un utente. */
	public function editUser($campo, $valore, $nickname) {
		return parent::query("UPDATE utenti SET $campo='$valore' WHERE nickname='$nickname'") ? true : false;
	}
	
	/* Crea un nuovo visitatore. */
	public function newVisitator() {
		$lastaction = time();
		$data = date('d-m-y');
		$ora = date('G:m:i');	
		$ip = parent::purge($_SERVER['REMOTE_ADDR']);
		if(!$visitator = $this->getVisitator()) // Mai nessun visitatore
			return parent::query("INSERT INTO visitatori(ip, lastaction, data, ora) VALUES('$ip', '$lastaction', '$data', '$ora')") ? true : false;
		else
			foreach($visitator as $v)
				if((($lastaction - $v->lastaction) > 60*5) && ($ip == $v->ip)) { // 5 minuti
					parent::query("UPDATE visitatori SET lastaction='$lastaction', data='$data', ora='$ora' WHERE ip='$ip'");
					return true;
				}
		return false;
	}
	
	/* Cancella i visitatori. */
	public function deleteVisitator() {
		return parent::query('DELETE FROM visitatori') ? true : false;
	}
	
	/* Elimina un utente. */
	public function deleteUser($nickname) {
		return parent::query("DELETE FROM utenti WHERE nickname='$nickname'") ? true : false;
	}
	
	/* Crea e ritorna un secret code. */
	public function getCode() {
		$code = parent::rng(12);
		$query = parent::query("SELECT COUNT(*) FROM utenti WHERE secret='$code'");
		if(mysql_result($query, 0, 0) > 0)
			while(mysql_result($query, 0, 0) > 0) {
				$code = parent::rng(12);
				$query = parent::query("SELECT COUNT(*) FROM utenti WHERE secret='$code'");
			}
		return $code;
	}
	
	/* Crea un cookie. */
	protected function setCookie($value) {
		setcookie($this->config[0]->cookie, $value, time()+3600);  /* expire in 1 hour */
	}
	
	/* Distrugge un cookie. */
	protected function unSetCookie() {
		setcookie($this->config[0]->cookie, '', -3600);
	}
	
	/* Ottiene un cookie. */
	public function getCookie() {
		return isset($_COOKIE[$this->config[0]->cookie]) ? parent::purge($_COOKIE[$this->config[0]->cookie]) : false;
	}
	
	/* Logga un utente. */
	public function login($nickname, $password) {
		if(!$this->isUser($nickname))
			return false;
		$password = md5($password);
		if(!$query = parent::query("SELECT COUNT(*) FROM utenti WHERE nickname='$nickname' AND password='$password' AND codiceregistrazione=''"))
			return false;
		if(mysql_result($query, 0, 0) > 0) {
			$code = $this->getCode();
			$client = parent::getClient();
			$ip = parent::purge($_SERVER['REMOTE_ADDR']);
			parent::query("UPDATE utenti SET secret='$code', ip='$ip', browsername='{$client['browser']}', browserversion='{$client['version']}', platform='{$client['platform']}' WHERE nickname='$nickname'");
			$this->setCookie($code);
			return true;
		}
		else
			return false;
	}
	
	/* Effettua il logout dell'utente. */
	public function logout() {
		$query = parent::query("SELECT COUNT(*) FROM utenti WHERE secret='{$this->getCookie()}'");
		if(mysql_result($query, 0, 0) > 0) {
			parent::query("UPDATE utenti SET secret='', lastlogout='".date('d-m-y')."' WHERE secret='{$this->getCookie()}'");
			$this->unSetCookie();
		}
		else
			$this->unSetCookie();
	}
	
	/* Registra un'azione di un utente in un log. */
	public function log($nickname, $azione) {
		$data = date('d-m-y');
		$ora = date('G:m:i');
		$useragent = parent::purge($_SERVER['HTTP_USER_AGENT']);
		$ip = parent::purge($_SERVER['REMOTE_ADDR']);
		$referer = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'?';
		foreach($_GET as $key => $value)
		    $referer .= "$key=$value&";
		$referer = trim($referer, '?');
		$referer = trim($referer, '&');
		$referer = parent::purge($referer);
		return parent::query("INSERT INTO log(nickname, azione, ip, data, ora, useragent, referer) VALUES('$nickname', '$azione', '$ip', '$data', '$ora', '{$useragent}', '$referer')") ? true : false;
	}

	/* Visualizza i log. */
	public function getLog($nickname = '') {
		$log = array();
		if($nickname !== '') {
			if($this->isUser($nickname)) {
				if(!$query = parent::query("SELECT * FROM log WHERE nickname='$nickname' ORDER BY id DESC"))
					return false;
				array_push($log, parent::get($query));
				if(!empty($log))
					return $log;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT * FROM log ORDER BY id DESC'))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($log, $result);
				if(!empty($log))
					return $log;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Elimina i log. */
	public function deleteLog() {
		return parent::query('DELETE FROM log') ? true : false;
	}
	
	/* Crea una sitemap di tutti gli utenti registrati */
	public function sitemapUser() {
		if(!$page = $this->getUser())
			return false;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($page as $v) {
			list($d, $m, $y) = explode('-', $v->data);
			$sitemap .= "
	<url>
		<loc>{$this->config[0]->url_index}/profilo.php?nickname={$v->nickname}</loc>
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
