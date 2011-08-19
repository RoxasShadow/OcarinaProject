<?php
/* Italian language file - Ocarina - (C) Giovanni Capuano 2011 - <http://www.giovannicapuano.net> */
function getLanguage_it() {
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
			'Cerca nel sito',
			
			/* Back-end*/
			'Amministrazione',
			'Approva',
			'Cancella news',
			'Cancella pagina',
			'Cancella utente',
			'Configurazione',
			'Crea news',
			'Crea pagina',
			'Gestisci categorie',
			'Immagini',
			'Log',
			'Modifica grado',
			'Modifica news',
			'Modifica pagina',
			'Robots',
			'Upload',
			'Crea annuncio',
			'Cancella annuncio',
			'Modifica annuncio',
			'Annunci',
			'Newsletter',
			'Disinstalla skin',
			'Installa skin',
			'Leggi MP',
			'Plugin'
		),
		
		'error' => array(
			'È accaduto un errore.',
			'Non è stata selezionata nessuna categoria.',
			'Nessuna news è associata alla categoria `{$cat}`.',
			'Nessuna pagina è associata alla categoria `{$cat}`.',
			'Accesso negato'
		),
		
		'database' => array(
			'Connessione al database fallita. Errore numero ',
			'La cartella contenente i file di cache non esiste.',
			'La cartella contenente i file di cache non è scrivibile.<br />Dovresti provare a correggere i permessi.'
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
			'L\'email da te immessa non corrisponde a nessun utente attualmente registrato.',
			'È accaduto un problema durante la modifica della password. Controlla di aver inserito correttamente l\'indirizzo email.',
			'Se hai già effettuato l\'accesso non hai bisogno di recuperare la tua password.',
			'Captcha non corrispondente.'
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
			'È accaduto un problema durante la registrazione. Controlla di aver inserito i dati correttamente e di non aver lasciato alcun campo vuoto.',
			'Captcha non corrispondente.'
		),
		
		'search' => array(
			'Non è stata trovata nessuna news corrispondente alla tua keyword.',
			'Non è stata trovata nessuna pagina corrispondente alla tua keyword.',
			'Non è stato trovato nessun commento corrispondente alla tua keyword.'
		),
		
		/* Back-end*/
		'approve' => array(
			'La news è stata approvata ed è ora visibile.',
			'È accaduto un errore durante l\'approvazione della news.',
			'Il commento è stato approvato ed è ora visibile.',
			'È accaduto un errore durante l\'approvazione del commento.',
			'La pagina è stata approvata ed è ora visibile.',
			'È accaduto un errore durante l\'approvazione della pagina.',
			'Non hai selezionato nulla da approvare.'
		),
		
		'deletenews' => array(
			'La news è stata cancellata.',
			'È accaduto un errore durante la cancellazione della news.',
			'Non sei abilitato a cancellare questa news.'
		),
		
		'deletepage' => array(
			'La pagina è stata cancellata.',
			'È accaduto un errore durante la cancellazione della pagina.',
			'Non sei abilitato a cancellare questa pagina.'
		),
		
		'deleteuser' => array(
			'L\'utente è stato cancellato.',
			'È accaduto un errore durante la cancellazione di {$nickname}.',
			'È accaduto un errore più o meno grave durante la cancellazione di {$nickname} insieme a tutti i suoi contenuti.',
			'L\'utente è stato cancellato insieme a tutti i suoi contenuti.'
		),
		
		'configuration' => array(
			'Le modifica alla configurazione sono state apportate con successo.',
			'È accaduto un errore durante la modifica alla configurazione.'
		),
		
		'createnews' => array(
			'È accaduto un errore durante la creazione della news. Esiste già una news con lo stesso titolo, prova a sceglierne un altro.',
			'La news è stata creata con successo ed è in attesa di approvazione.',
			'La news è stata creata con successo.',
			'È accaduto un errore durante la creazione della news.',
			'È accaduto un errore durante la creazione della news. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'createpage' => array(
			'È accaduto un errore durante la creazione della pagina. Esiste già una pagina con lo stesso titolo, prova a sceglierne un altro.',
			'La pagina è stata creata con successo ed è in attesa di approvazione.',
			'La pagina è stata creata con successo.',
			'È accaduto un errore durante la creazione della pagina.',
			'È accaduto un errore durante la creazione della pagina. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'managecategory' => array(
			'La categoria è stata creata con successo.',
			'È accaduto un errore durante la creazione della categoria.',
			'La categoria è stata rimossa con successo.',
			'È accaduto un errore durante la rimozione della categoria.',
			'Eliminazione negata per la categoria `Senza categoria`.'
		),
		
		'log' => array(
			'I log sono stati cancellati',
			'È accaduto un errore durante la cancellazione dei log.',
			'Non sei abilitato a cancellare i log.'
		),
		
		'editgrade' => array(
			'Grado modificato.',
			'È accaduto un errore durante la modifica del grado di {$nickname}.'
		),
		
		'editnews' => array(
			'Scegli la news da modificare',
			'È accaduto un errore, la news selezionata non esiste.',
			'Non sei abilitato a modificare questa news.',
			'La news è stata modificata.',
			'È accaduto un errore durante la modifica della news. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'editpage' => array(
			'Scegli la pagina da modificare',
			'È accaduto un errore, la pagina selezionata non esiste.',
			'Non sei abilitato a modificare questa pagina.',
			'La pagina è stata modificata.',
			'È accaduto un errore durante la modifica della pagina. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'robots' => array(
			'# Robots generato il {$date} tramite Ocarina CMS.'
		),
		
		'upload' => array(
			'È accaduto un errore durante il caricamento del file nel server.',
			'È accaduto un errore durante l\'installazione del plugin nel server.',
			'Il plugin è stato installato correttamente.',
			'Il plugin risulta già installato.'
		),
		
		'createad' => array(
			'È accaduto un errore durante la creazione dell\'annuncio. Esiste già un annuncio con lo stesso titolo, prova a sceglierne un altro.',
			'L\'annuncio è stato creato con successo.',
			'È accaduto un errore durante la creazione dell\'annuncio.',
			'È accaduto un errore durante la creazione dell\'annuncio. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'deletead' => array(
			'L\'annuncio è stato cancellato.',
			'È accaduto un errore durante la cancellazione dell\'annuncio.',
			'Non sei abilitato a cancellare quest\'annuncio.'
		),
		
		'editad' => array(
			'Scegli l\'annuncio da modificare',
			'È accaduto un errore, l\'annuncio selezionato non esiste.',
			'Non sei abilitato a modificare quest\'annuncio.',
			'L\'annuncio è stata modificata.',
			'È accaduto un errore durante la modifica dell\'annuncio. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'newsletter' => array(
			'Tutte le {$sended} newsletter sono state inviate.',
			'{$notsended} newsletter su {$sended} non sono state inviate.',
			'È accaduto un errore durante l\'invio delle newsletter. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		'removeskin' => array(
			'La skin è stata disinstallata.',
			'È accaduto un errore durante la disinstallazione della skin. Controlla che la skin selezionata esiste.'
		),
		
		'disinstallplugin' => array(
				'Il plugin non esiste, e pertanto non può essere disinstallato.',
				'È accaduto un errore durante la disinstallazione del plugin.',
				'Il plugin è stato disinstallato correttamente.'
		),
		
		'installskin' => array(
			'La skin è stata installata.',
			'È accaduto un errore durante l\'installazione della skin.'
		),
		
		'sendpm' => array(
			'PM sended.',
			'È accaduto un errore durante l\'invio dell\'MP.',
			'È accaduto un errore durante l\'invio dell\'MP. Controlla di non aver lasciato alcun campo vuoto.'
		),
		
		400 => array(
			'400',
			'Bad Request',
			'Il tuo browser ha inviato una richiesta che questo server potrebbe non comprendere.'
		),
		
		403 => array(
			'403',
			'Forbidden',
			'Non hai permessi sufficienti per accedere in questa pagina.'
		),
		
		404 => array(
			'404',
			'Not Found',
			'La pagina richiesta non è stata trovata.'
		),
		
		500 => array(
			'500',
			'Internal Server Error',
			'È accaduto un errore interno al server.'
		),
		
		503 => array(
			'503',
			'Service Temporarily Unavailable',
			'Il server non può al momento elaborare la tua richiesta.'
		)
	);
}
