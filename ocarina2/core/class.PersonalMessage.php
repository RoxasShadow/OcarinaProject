<?php
/**
	core/class.PersonalMessage.php
	(C) Giovanni Capuano 2011
*/
require_once('class.User.php');

/* Questa classe mette a disposizione dei metodi per gestire i messaggi personali. */
class PersonalMessage extends User {

	/* Ottiene uno o più mp. */
	public function getPM($id = '', $nickname = '') {
		$pm = array();
		if($id !== '') {
			if($this->isPM($id)) {
				if(!$query = parent::query("SELECT * FROM {$this->prefix}personalmessage WHERE id='$id' LIMIT 1"))
					return false;
				array_push($pm, parent::get($query));
				if(!empty($pm))
					return $pm;
				return false;
			}
			return false;
		}
		elseif($nickname !== '') {
			if(!$query = parent::query("SELECT * FROM {$this->prefix}personalmessage WHERE destinatario='$nickname' ORDER BY id"))
				return false;
			if(parent::count($query) > 0) {
				while($result = parent::get($query))
					array_push($pm, $result);
				if(!empty($pm))
					return $pm;
				return false;
			}
			return false;
		}
		return false;
	}
	
	/* Controlla se l'MP esiste. */
	public function isPM($id) {
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}personalmessage WHERE id='$id'"))
			return false;
		return mysql_result($query, 0, 0) > 0 ? true : false;
	}
	
	/* Conta quanti pm sono presenti nel database. */
	public function countPM() {
		if(!parent::isLogged())
			return false;
		$nickname = $this->username[0]->nickname;
		if(!$query = parent::query("SELECT COUNT(*) FROM {$this->prefix}personalmessage WHERE destinatario='$nickname' AND letto='0'"))
				return 0;
		return mysql_result($query, 0, 0);
	}

	/* Crea un mp. */
	public function createPM($array) {
		if(empty($array))
			return false;
		if((parent::isUser($array[0])) && (parent::isUser($array[1]))) {
			$query = parent::query('SELECT * FROM '.$this->prefix.'personalmessage LIMIT 1');
			if(!$campi = parent::getColumns($query))
				return false;
			$query = 'INSERT INTO '.$this->prefix.'personalmessage(';
			foreach($campi as $var)
				if($var !== 'id')
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
	
	/* Modifica un mp come già letto. */
	public function readedPM($id) {
		return parent::query("UPDATE {$this->prefix}personalmessage SET letto='1'") ? true : false;
	}
	
	/* Elimina un mp. */
	public function deletePM($id) {
		return parent::query("DELETE FROM {$this->prefix}personalmessage WHERE id='$id'") ? true : false;
	}
}
