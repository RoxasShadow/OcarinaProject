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
	public $salt = 'njhbijk2gfcvgjiu8yt6';
	
	public function __construct() {
		parent::__construct();
		$this->logged = $this->isLogged();
		$this->username = $this->logged ? $this->searchUserByField('secret', $this->getCookie()) : false;
	}

	/* Ottiene uno o più utenti. */
	public function getUser($nickname = '') {
		if($nickname !== '')
			if($this->isUser($nickname))
				return ($result = parent::get("SELECT * FROM {$this->prefix}utenti WHERE nickname='$nickname' LIMIT 1")) ? $result : false;
			else
				return false;
		else
			return ($result = parent::get('SELECT * FROM '.$this->prefix.'utenti ORDER BY nickname ASC')) ? $result : false;
	}

	/* Ottiene i visitatori. */
	public function getVisitator() {
		return ($result = parent::get('SELECT * FROM '.$this->prefix.'visitatori ORDER BY id ASC')) ? $result : false;
	}
	
	/* Controlla se l'utente esiste. */
	public function isUser($nickname) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE nickname='$nickname'") > 0 ? true : false;
	}
	
	/* Controlla se l'email è già usata da un altro utente. */
	public function isEmailUsed($nickname, $email) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE email='$email' AND nickname<>'$nickname'") > 0 ? true : false;
	}
	
	/* Conta quanti utenti sono presenti nel database. */
	public function countUser() {
		return parent::resultCountQuery('SELECT COUNT(*) FROM '.$this->prefix.'utenti');
	}
	
	/* Controlla se l'utente è loggato. */
	public function isLogged() {
		if(!$cookie = $this->getCookie()) {
			$this->newVisitator(false);
			return false;
		}
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$cookie'") <= 0) {
			$this->newVisitator(false);
			return false;
		}
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$cookie'") > 0) {
			$this->newVisitator(true);
			return true;
		}
		else {
			$this->newVisitator(false);
			return false;
		}
	}
	
	/* Ritorna la lista di utenti online. */
	public function getUserOnline() {
		$data = time();
		if(!$user = $this->getVisitator())
			return false;
		$userOnline = array();
		foreach($user as $v)
			if((($data - $v->lastaction) <= 60 * $this->config[0]->limiteonline) && ($v->nickname !== ''))
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
			if((($data - $v->lastaction) <= 60 * $this->config[0]->limiteonline) && ((!isset($v->nickname)) || ($v->nickname == ''))) 
				++$visitatorOnline;
		return $visitatorOnline;
	}
	
	/* Ritorna il numero totale di visite. */
	public function getTotalVisits() {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}visitatori");
	}
	
	/* Ricerca gli utenti per un campo specifico. */
	public function searchUserByField($campo, $valore) {
		return ($result = parent::get("SELECT * FROM {$this->prefix}utenti WHERE $campo='$valore' ORDER BY nickname ASC")) ? $result : false;
	}
	
	/* Crea un nuovo utente. */
	public function createUser($array) {
		if(empty($array))
			return false;
		if((!$this->isUser($array[0])) && (parent::isEmail($array[2]))) {
			if(!$campi = parent::getColumns('SELECT * FROM '.$this->prefix.'utenti LIMIT 1'))
				return false;
			$array[1] = md5($this->salt.$array[1]);
			$query = 'INSERT INTO '.$this->prefix.'utenti(';
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
		return parent::query("UPDATE {$this->prefix}utenti SET $campo='$valore' WHERE nickname='$nickname'") ? true : false;
	}
	
	/* Crea un nuovo visitatore. */
	public function newVisitator($logged) {
		$lastaction = time();
		$giorno = date('d');
		$data = date('d-m-y');
		if($logged) {
			$username = $this->searchUserByField('secret', $this->getCookie());
			$nickname = $username[0]->nickname;
		}
		else
			$nickname = '';
		if(!$visitator = $this->getVisitator()) // Mai nessun visitatore
			return parent::query("INSERT INTO {$this->prefix}visitatori(ip, lastaction, giorno, data, nickname) VALUES('{$_SERVER['REMOTE_ADDR']}', '$lastaction', '$giorno', '$data', '$nickname')") ? true : false;
		else {
			$found = 0;
			foreach($visitator as $v)
				if($v->ip == $_SERVER['REMOTE_ADDR'])
					++$found;
			if($found == 0)
				return parent::query("INSERT INTO {$this->prefix}visitatori(ip, lastaction, giorno, data, nickname) VALUES('{$_SERVER['REMOTE_ADDR']}', '$lastaction', '$giorno', '$data', '$nickname')") ? true : false;
			elseif((($lastaction - $v->lastaction) > 60 * $this->config[0]->limiteonline) && ($found > 0))
				return parent::query("UPDATE {$this->prefix}visitatori SET lastaction='$lastaction', giorno='$giorno', nickname='$nickname' WHERE ip='{$_SERVER['REMOTE_ADDR']}'") ? true : false;
		}
		return false;
	}
	
	/* Elimina un utente. */
	public function deleteUser($nickname) {
		return parent::query("DELETE FROM {$this->prefix}utenti WHERE nickname='$nickname'") ? true : false;
	}
	
	/* Crea e ritorna un secret code. */	
	public function getCode() {
		$code = parent::rng(12);
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$code'") <= 0)
			return $code;
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$code'") > 0)
			while(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$code'") > 0) {
				$code = parent::rng(12);
				if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='$code'") > 0)
					return $code;
			}
		return $code;
	}
	
	/* Crea un cookie. */
	protected function setCookie($value) {
		setcookie($this->config[0]->cookie, $value, time()+$this->config[0]->loginexpire);
	}
	
	/* Distrugge un cookie. */
	protected function unSetCookie() {
		setcookie($this->config[0]->cookie, '', -$this->config[0]->loginexpire);
	}
	
	/* Ottiene un cookie. */
	public function getCookie() {
		return isset($_COOKIE[$this->config[0]->cookie]) ? parent::purge($_COOKIE[$this->config[0]->cookie]) : false;
	}
	
	/* Logga un utente. */
	public function login($nickname, $password) {
		if(!$this->isUser($nickname))
			return false;
		$password = md5($this->salt.$password);
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE nickname='$nickname' AND password='$password' AND codiceregistrazione=''") > 0) {
			$code = $this->getCode();
			$client = parent::getClient();
			parent::query("UPDATE {$this->prefix}utenti SET secret='$code', ip='{$_SERVER['REMOTE_ADDR']}', browsername='{$client['browser']}', browserversion='{$client['version']}', platform='{$client['platform']}' WHERE nickname='$nickname'");
			$this->setCookie($code);
			return true;
		}
		else
			return false;
	}
	
	/* Effettua il logout dell'utente. */
	public function logout() {
		if(parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}utenti WHERE secret='{$this->getCookie()}'") > 0) {
			parent::query("UPDATE {$this->prefix}utenti SET secret='', lastlogout='".date('d-m-y')."' WHERE secret='{$this->getCookie()}'");
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
		$referer = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'?';
		foreach($_GET as $key => $value)
		    $referer .= "$key=$value&";
		$referer = trim($referer, '?');
		$referer = trim($referer, '&');
		$referer = parent::purge($referer);
		return parent::query("INSERT INTO {$this->prefix}log(nickname, azione, ip, data, ora, useragent, referer) VALUES('$nickname', '$azione', '{$_SERVER['REMOTE_ADDR']}', '$data', '$ora', '{$useragent}', '$referer')") ? true : false;
	}

	/* Visualizza i log. */
	public function getLog($min = '', $max = '') {
		if(($min == '') && ($max == ''))
			return ($result = parent::get('SELECT * FROM '.$this->prefix.'log ORDER BY id DESC')) ? $result : false;
		else
			return ($result = parent::get("SELECT * FROM {$this->prefix}log ORDER BY id DESC LIMIT $min, $max")) ? $result : false;
	}

	/* Conta i log. */
	public function countLog() {
		return parent::resultCountQuery('SELECT COUNT(*) FROM '.$this->prefix.'log');
	}
	
	/* Elimina i log. */
	public function deleteLog() {
		return parent::query('DELETE FROM '.$this->prefix.'log') ? true : false;
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
		<loc>{$this->config[0]->url_index}/profile/{$v->nickname}.html</loc>
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
