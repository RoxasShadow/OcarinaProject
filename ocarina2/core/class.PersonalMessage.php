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
		if($id !== '')
			if($this->isPM($id))
				return ($result = parent::get("SELECT * FROM {$this->prefix}personalmessage WHERE id='$id' LIMIT 1")) ? $result : false;
			else
				return false;
		elseif($nickname !== '')
			return ($result = parent::get("SELECT * FROM {$this->prefix}personalmessage WHERE destinatario='$nickname' ORDER BY id")) ? $result : false;
		else
			return false;
	}
	
	/* Controlla se l'MP esiste. */
	public function isPM($id) {
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}personalmessage WHERE id='$id'") > 0 ? true : false;
	}
	
	/* Conta quanti pm sono presenti nel database. */
	public function countPM() {
		if(!parent::isLogged())
			return false;
		$nickname = $this->username[0]->nickname;
		return parent::resultCountQuery("SELECT COUNT(*) FROM {$this->prefix}personalmessage WHERE destinatario='$nickname' AND letto='0'");
	}

	/* Crea un mp. */
	public function createPM($array) {
		if(empty($array))
			return false;
		if((parent::isUser($array[0])) && (parent::isUser($array[1]))) {
			$query = 'INSERT INTO '.$this->prefix.'personalmessage(mittente, destinatario, data, ora, oggetto, contenuto, letto) VALUES(';
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
