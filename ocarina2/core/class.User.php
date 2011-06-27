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
				if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE nickname='$nickname' ORDER BY nickname ASC"))
					return false;
				array_push($utenti, parent::get($query));
				if(is_array($utenti))
					return $utenti;
				return false;
			}
			return false;
		}
		else {
			if(!$query = parent::query('SELECT DISTINCT * FROM utenti ORDER BY nickname ASC'))
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
		if(!$query = parent::query("SELECT * FROM utenti WHERE nickname='$nickname' ORDER BY nickname ASC"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Controlla se l'email è già usata da un altro utente. */
	public function isEmailUsed($nickname, $email) {
		if(!$query = parent::query("SELECT * FROM utenti WHERE email='$email' AND nickname<>'$nickname' ORDER BY nickname ASC"))
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
	public function isLogged() {
		$cookie = $this->getCookie();
		if(!$cookie)
			return false;
		if(!$query = parent::query("SELECT * FROM utenti WHERE secret='$cookie' ORDER BY nickname ASC"))
			return false;
		return parent::count($query) > 0 ? true : false;
	}
	
	/* Ricerca gli utenti per un campo specifico. */
	public function searchUserByField($campo, $valore) {
		if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE $campo='$valore' ORDER BY nickname ASC"))
			return false;
		if(parent::count($query) > 0) {
			$utenti = array();
			while($result = parent::get($query))
				array_push($utenti, $result);
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
			$query = parent::query('SELECT * FROM utenti ORDER BY nickname ASC');
			$campi = parent::getColumns($query);
			if(!is_array($campi))
				return false;
			$array[1] = md5($array[1]);
			$query = 'INSERT INTO utenti(';
			foreach($campi as $var)
				if(($var !== 'id') && ($var !== 'secret') && ($var !== 'bio') && ($var !== 'avatar') && ($var !== 'lastlogout') && ($var !== 'browsername') && ($var !== 'browserversion') && ($var !== 'platform') && ($var !== 'codicerecupero'))
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
		$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code' ORDER BY nickname ASC");
		while(parent::count($query) > 0) {
			$code = parent::rng(12);
			$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code' ORDER BY nickname ASC");
		}
		return $code;
	}
	
	/* Crea un cookie. */
	public function setCookie($value) {
		$config = parent::getConfig('cookie');
		setcookie($config[0]->cookie, $value, time()+3600);  /* expire in 1 hour */
	}
	
	/* Distrugge un cookie. */
	public function unSetCookie() {
		$config = parent::getConfig('cookie');
		setcookie($config[0]->cookie, '', -3600);
	}
	
	/* Ottiene un cookie. */
	public function getCookie() {
		$config = parent::getConfig('cookie');
		return isset($_COOKIE[$config[0]->cookie]) ? parent::purge($_COOKIE[$config[0]->cookie]) : false;
	}
	
	/* Logga un utente. */
	public function login($nickname, $password) {
		if(!$this->isUser($nickname))
			return false;
		$password = md5($password);
		if(!$query = parent::query("SELECT DISTINCT * FROM utenti WHERE nickname='$nickname' AND password='$password' ORDER BY nickname ASC"))
			return false;
		if(parent::count($query) > 0) {
			$code = $this->getCode();
			$client = parent::getClient();
			parent::query("UPDATE utenti SET secret='$code', browsername='{$client['browser']}', browserversion='{$client['version']}', platform='{$client['platform']}' WHERE nickname='$nickname'");
			$this->setCookie($code);
			return true;
		}
		else
			return false;
	}
	
	/* Effettua il logout dell'utente. */
	public function logout() {
		$code = $this->getCookie();
		$query = parent::query("SELECT DISTINCT * FROM utenti WHERE secret='$code' ORDER BY nickname ASC");
		if(parent::count($query) > 0) {
			$data = date('d-m-y');
			parent::query("UPDATE utenti SET secret='', lastlogout='$data' WHERE secret='$code'");
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
		$referer = parent::purge($_SERVER['HTTP_REFERER']);
		return parent::query("INSERT INTO log(nickname, azione, ip, data, ora, useragent, referer) VALUES('$nickname', '$azione', '{$_SERVER['REMOTE_ADDR']}', '$data', '$ora', '$useragent', '$referer')") ? true : false;
	}
}
