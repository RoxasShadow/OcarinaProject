<?php
/**
	core/class.User.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Configuration.php');

/* Questa classe mette a disposizione dei metodi per gestire gli utenti. */
class User extends Configuration {

	/* Ottiene uno o più utenti. */
	public function getUser($nickname = '') {
		$utenti = array();
		if($nickname !== '') {
			if($this->isUser($nickname)) {
				if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE nickname='$nickname'"))
					return false;
				array_push($utenti, parent::get($query));
				if(is_array($utenti))
					return $utenti;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query("SELECT DISTINCT * FROM utenti"))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($utenti, $result);
				if(is_array($utenti))
					return $utenti;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se l'utente esiste. */
	public function isUser($nickname) {
		if(!$query = parent::query("SELECT * FROM utenti WHERE nickname='$nickname'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Conta quanti utenti sono presenti nel database. */
	public function countUser() {
		if(!$query = parent::query('SELECT COUNT(*) FROM utenti'))
			return false;
		return mysql_result($query, 0, 0);
	}
	
	/* Controlla se l'utente è loggato. */
	public function isLogged($secret) {
		if(!$query = parent::query("SELECT * FROM utenti WHERE secret='$secret'"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Ricerca gli utenti per un campo specifico. */
	public function searchUserByField($campo, $valore) {
		if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE $campo LIKE '%$valore%'"))
			return false;
		if(parent::count($query) > 0) {
			$utenti = array();
			array_push($utenti, parent::get($query));
			if(is_array($utenti))
				return $utenti;
			return false;
		}
		else
			return false;
	}
	
	/* Crea un commento. */
	public function createUser($array) {
		if(!is_array($array))
			return false;
		if((!$this->isUser($array[0])) && (parent::isEmail($array[2]))) {
			$query = parent::query('SELECT * FROM utenti');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$array[1] = md5($array[1]);
			$query = 'INSERT INTO utenti(';
			foreach($campi as $var)
				if(($var !== 'id') && ($var !== 'secret') && ($var !== 'bio') && ($var !== 'avatar') && ($var !== 'lastlogout'))
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
	
	/* Elimina un utente. */
	public function deleteUser($nickname) {
		return parent::query("DELETE FROM utenti WHERE nickname='$nickname'") ? true : false;
	}
	
	/* Crea e ritorna un secret code. */
	public function getCode() {
		$code = parent::rng(12);
		$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code'");
		while(parent::count($query) > 0) {
			$code = parent::rng(12);
			$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code'");
		}
		return $code;
	}
	
	/* Crea un cookie. */
	public function setCookie($value) {
		$cookie = '';
		foreach(parent::getConfig('cookie') as $v)
			$cookie = $v->cookie;
		setcookie($cookie, $value, time()+3600);  /* expire in 1 hour */
	}
	
	/* Distrugge un cookie. */
	public function unSetCookie() {
		$cookie = '';
		$config = parent::getConfig('cookie');
		$cookie = $config[0];
		setcookie($cookie, '', -3600);
	}
	
	/* Ottiene un cookie. */
	public function getCookie() {
		$cookie = '';
		$config = parent::getConfig('cookie');
		$cookie = $config[0];
		return isset($_COOKIE[$cookie]) ? parent::purge($_COOKIE[$cookie]) : false;
	}
	
	/* Logga un utente. */
	public function login($nickname, $password) {
		if(!$this->isUser($nickname))
			return false;
		$password = md5($password);
		if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE nickname='$nickname' AND password='$password'"))
			return false;
		if(parent::count($query) > 0) {
			$code = $this->getCode();
			parent::query("UPDATE utenti SET secret='$code' WHERE nickname='$nickname'");
			$this->setCookie($code);
			return true;
		}
		else
			return false;
	}
	
	/* Effettua il logout dell'utente. */
	public function logout() {
		$code = $this->getCookie();
		$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code'");
		if(parent::count($query) > 0) {
			parent::query("UPDATE utenti SET secret='' WHERE secret='$code'");
			$this->unSetCookie();
		}
		else
			$this->unSetCookie();
	}
}
