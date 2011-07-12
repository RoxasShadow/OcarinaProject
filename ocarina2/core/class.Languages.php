<?php
/**
	core/class.Languages.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe include le lingue per il core. */
class Languages {

	/* Ritorna una stringa nella lingua usata dall'utente. */
	public function getLanguage($category, $val) {
		$language = substr($this->purge($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2);
		if($language == 'it')
			$language = $this->getItalianStrings();
		return ((!isset($language[$category])) || (!is_array($language[$category])) || (empty($language[$category])) || ((count($language[$category])) < $val)) ? 'Description not found.' : $language[$category][$val];
	}
	
	public function getItalianStrings() {
		return array(
			/* Front-end */
			'description' => array(
				'In questa pagina troverai raccolte tutte le pagine e le news che sono state create.',
				'In questa pagina troverai raccolte tutte le pagine e le news raccolte in una determinata categoria.',
				'In questa pagina potrai accedere al sito e usufruire di tutti i suoi servizi.',
				'In questa pagina potrai modificare la tua password.',
				'In questa pagina potrai modificare il tuo profilo.',
				'In questa pagina potrai visualizzare i profili degli utenti registrati.',
				'Il profilo di ',
				'In questa pagina potrai recuperare la tua password.',
				'In questa pagina potrai registrarti al sito e usufruire di tutti i suoi servizi.',
				'In questa pagina potrai cercare tutti i contenuti che desideri.'
			),
			'title' => array(
				/* Front-end */
				'Categoria: ',
				'Commento numero #{$num}',
				' &raquo; ',
				'Errore ',
				'Login',
				'Modifica password',
				'Modifica profilo',
				'Recupera password',
				'Registrazione',
				'Cerca nel sito'
				/* Back-end*/
			),
			'error' => array(
				'È accaduto un errore',
				'Non è stata selezionata nessuna categoria.',
				'Nessuna news è associata alla categoria `{$cat}`.',
				'Nessuna pagina è associata alla categoria `{$cat}`.',
			),
			'news' => array(
				'Leggi altro...',
				'Non è stata selezionata nessuna news.',
				'La news selezionata non è stata trovata.',
				'Nessun commento ancora presente.',
				'I commenti sono attualmente bloccati, attendi per il redirect...',
				'Il commento è stato inviato, attendi per il redirect...',
				'Il commento è stato inviato ed è in attesa per essere approvato, attendi per il redirect...',
				'È accaduto un errore nell\'invio del commento, attendi per il redirect...',
				'Solo gli utenti registrati possono commentare le news, attendi per il redirect...'
			),
			'page' => array(
				'Non è stata selezionata nessuna pagina.',
				'La pagina selezionata non è stata trovata.'
			),
			'comment' => array(
				'Non è stato selezionato nessun commento.',
				'Il commento selezionato non è stato trovato.'
			),
			'login' => array(
				'Login effettuato. Attendi per il redirect...',
				'È accaduto un problema durante l\'accesso. Controlla di aver inserito i dati correttamente e che il tuo account sia attivo.',
				'È accaduto un problema durante l\'accesso. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.'
			),
			'editpassword' => array(
				'La password è stata modificata con successo. Attendi per il redirect...',
				'È accaduto un errore durante la modifica della password.',
				'È accaduto un errore durante la modifica della password. Le cause possono essere diverse, tra cui l\'errato inserimento della vecchia password, la non coincidenza delle password immesse, oppure semplicemente la password da te immessa è minore di 4 caratteri.',
				'È accaduto un problema durante la modifica della password. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.',
				'Devi effettuare l\'accesso prima di poter modificare la password.'
			),
			'editprofile' => array(
				'È accaduto un errore durante la modifica del profilo. Controlla che l\'indirizzo email da te dato non sia già in uso e che la password sia corretta.',
				'Il profilo è stato modificato con successo. Attendi per il redirect...',
				'È accaduto un errore durante la modifica del profilo.',
				'È accaduto un errore durante la modifica del profilo. Controlla di aver inserito un indirizzo email e un avatar validi e di non aver lasciato alcun campo vuoto.',
				'Devi effettuare l\'accesso prima di poter modificare il tuo profilo.'
			),
			'profile' => array(
				'Profili degli utenti',
				'Il tuo profilo',
				'Profilo di ',
				'L\'utente da te cercato non è attualmente registrato.'
			),
			'recoverpassword' => array(
				'Il codice per il recupero da te inserito non è valido.',
				'La tua nuova password è {$password} Se vuoi, puoi modificarla dopo aver effettuato l\'accesso.',
				'È accaduto un problema durante la reimpostazione della password.',
				'Il codice per il recupero da te inserito non è valido.',
				'È stata inviata una email all\'indirizzo da te dato per aiutarti a recuperare la password.',
				'È accaduto un problema durante il recupero della password.',
				'L\'email da immessa non corrisponde a nessun utente attualmente registrato.',
				'È accaduto un problema durante la modifica della password. Controlla di aver inserito correttamente l\'indirizzo email.',
				'Se hai già effettuato l\'accesso non hai bisogno di recuperare la tua password.'
			),
			'registration' => array(
				'Sei già registrato, non hai bisogno di registrarti nuovamente.',
				'Non hai bisogno di validare il tuo account, puoi accedere senza problemi già da ora.',
				'Il codice per la validazione dell\'account da te inserito non è valido.',
				'Account validato. Ora è possibile accedere.',
				'È accaduto un errore nella validazione dell\'account.',
				'Le registrazioni sono chiuse.',
				'Registrazione completata. A breve riceverai l\'email per attivare il tuo account. Attendi per il redirect...',
				'È accaduto un problema durante la registrazione. Controlla di non usare un nickname o un\'email già usata da un altro utente, e che quest\'ultima sia valida.',
				'Registrazione completata. Attendi per il redirect...',
				'È accaduto un problema durante la registrazione. Controlla di non usare un nickname o un\'email già usata da un altro utente, e che quest\'ultima sia valida.',
				'È accaduto un problema durante la registrazione: le due password non corrispondono oppure la password o il nickname da te immessi hanno meno di 4 caratteri. Attendi per il redirect...',
				'È accaduto un problema durante la registrazione. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.'
			),
			'search' => array(
				'Non è stata trovata nessuna news corrispondente alla tua keyword.',
				'Non è stata trovata nessuna pagina corrispondente alla tua keyword.',
				'Non è stato trovato nessun commento corrispondente alla tua keyword.'
			)
			/* Back-end*/
		);
	}
}
