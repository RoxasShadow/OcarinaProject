<?php
if(isset($_COOKIE['host'])) {
$host = $_COOKIE['host'];
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$database = $_COOKIE['database'];

$class = <<<EOF
<?php
/* Questa classe include tutti i metodi per la gestione del database */
class MySQL {

// Definisco i dati di accesso al db
private \$host='$host'; // L'host del database
private \$user='$username'; // L'username per accedere al database
private \$database='$database'; // Il nome del database
private \$password='$password'; // La password del database
private \$attiva = false;

/* FUNZIONI DATABASE */

// Connessione al database
public function connettidb() {
	if(!\$this->attiva) {
		if(\$connessione = mysql_connect(\$this->host,\$this->user,\$this->password)) {
			\$accesso = mysql_select_db(\$this->database,\$connessione);
		}
	}
	else {
		return true;
	}
}

// Disconnessione dal database
public function disconnettidb() {
	if(\$this->attiva) {
		if(mysql_close()) {
		\$this->attiva = false;
			return true;
		}
		else {
			return false;
		}
	}
}

// Crea una query e la esegue (utile per UPDATE e DELETE)
public function query(\$query) {
	\$query = mysql_query(\$query);
	return \$query;
}

// Conta record nel database
public function conta(\$query) {
	return mysql_num_rows(\$query);
}

// Estrae record nel database (e con echo le mostra)
public function estrai(\$query) {
	\$result = mysql_fetch_object(\$query);
	return \$result;
}

// Dal cookie effettua l' autenticazione dell' utente
public function auth(\$codice) {
	\$codice = trim(\$codice);
	\$codice = htmlspecialchars(\$codice);

	if(\$codice == '') {
		\$logged = 0;
		return \$logged;
		break;
	}

	// Mi connetto al database
	\$this->connettidb();

	// Creo la query
	\$query = \$this->query("SELECT * FROM utenti WHERE codice='\$codice'");

	// Verifico se ci sono risultati
	\$verifica = \$this->conta(\$query);

	if(\$verifica > 0) {
		while (\$riga = \$this->estrai(\$query)) {
			// Prelevo i record delle colonne
			\$grado = \$riga->grado;
			\$nickname = \$riga->nickname;
		}

		// 1 = Accesso al CMS, 0 = Accesso negato al CMS
		if(\$grado == 'Webmaster') {
			\$logged = 2;
		}
		elseif(\$grado == 'Editore') {
			\$logged = 2;
		}
		else {
			\$logged = 1;
		}
	}
	else {
		\$logged = 0;
	}
	// Mi disconnetto dal database
	\$this->disconnettidb();
	return \$logged;
}

// Verifica il nickname dell'utente
public function nickname(\$codice) {
	\$codice = trim(\$codice);
	\$codice = htmlspecialchars(\$codice);

	// Mi connetto al database
	\$this->connettidb();

	// Creo la query
	\$query = \$this->query("SELECT * FROM utenti WHERE codice='\$codice'");

	// Verifico se ci sono risultati
	\$verifica = \$this->conta(\$query);

	if(\$verifica > 0) {
		while (\$riga = \$this->estrai(\$query)) {
			// Prelevo i record delle colonne
			\$nickname = \$riga->nickname;
		}
	}
	else {
		\$nickname = 0;
	}
	\$this->disconnettidb();
	return \$nickname;
}

// Verifica l'email dell'utente
public function email(\$codice) {
	\$codice = trim(\$codice);
	\$codice = htmlspecialchars(\$codice);


	// Mi connetto al database
	\$this->connettidb();

	// Creo la query
	\$query = \$this->query("SELECT * FROM utenti WHERE codice='\$codice'");

	// Verifico se ci sono risultati
	\$verifica = \$this->conta(\$query);

	if(\$verifica > 0) {
		while (\$riga = \$this->estrai(\$query)) {
			// Prelevo i record delle colonne
			\$email = \$riga->email;
		}
	}
	else {
		\$email = 0;
	}
	\$this->disconnettidb();
	return \$email;
}

// Verifica il grado dell'utente
public function grado(\$codice) {

	\$codice = trim(\$codice);
	\$codice = htmlspecialchars(\$codice);


	// Mi connetto al database
	\$this->connettidb();

	// Creo la query
	\$query = \$this->query("SELECT * FROM utenti WHERE codice='\$codice'");

	// Verifico se ci sono risultati
	\$verifica = \$this->conta(\$query);

	if(\$verifica > 0) {
		while (\$riga = \$this->estrai(\$query)) {
			// Prelevo i record delle colonne
			\$grado = \$riga->grado;
		}
	}
	else {
		\$grado = 0;
	}
	\$this->disconnettidb();
	return \$grado;
}


/* SITEMAP */


// News
public function news_sitemap(\$linknews,\$root) {
	\$this->connettidb();

	\$header = '<?xml version="1.0" encoding="UTF-8"?>';
	\$header .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	\$query = \$this->query("SELECT minititolo,data,dataultimamodifica FROM news");
	while(\$riga = \$this->estrai(\$query)) {
	\$minititolo = \$linknews.\$riga->minititolo;

	if(\$riga->dataultimamodifica == '') {
		\$lastmod=\$riga->data;
	}
	else {
		\$lastmod=\$riga->dataultimamodifica;
	}
	\$lastmod=explode("-", \$lastmod);
	\$lastmod='20'.\$lastmod[2].'-'.\$lastmod[1].'-'.\$lastmod[0];

	\$header .= '
		   <url>
		      <loc>'.\$minititolo.'</loc>
		      <lastmod>'.\$lastmod.'</lastmod>
		      <changefreq>hourly</changefreq>
		      <priority>0.8</priority>
		   </url>
		   ';
	}

	\$header .= '</urlset>';
	\$sitemapxml=fopen(\$root."sitemap_news.xml","w+");
	fwrite(\$sitemapxml, \$header);
	\$this->disconnettidb();
}

// Sezioni
public function sezioni_sitemap(\$link,\$linksezioni,\$root) {
	\$this->connettidb();

	\$header = '<?xml version="1.0" encoding="UTF-8"?>';
	\$header .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	\$header .= '
		   <url>
		      <loc>'.\$link.'</loc>
		      <changefreq>always</changefreq>
		      <priority>1.0</priority>
		   </url>
		   ';

	\$query = \$this->query("SELECT minititolo,datacreazione,dataultimamodifica FROM pagine");
	while(\$riga = \$this->estrai(\$query)) {
	\$minititolo = \$linksezioni.\$riga->minititolo;

	if(\$riga->dataultimamodifica == '') {
		\$lastmod=\$riga->datacreazione;
	}
	else {
		\$lastmod=\$riga->dataultimamodifica;
	}
	\$lastmod=explode("-", \$lastmod);
	\$lastmod='20'.\$lastmod[2].'-'.\$lastmod[1].'-'.\$lastmod[0];

	\$header .= '
		   <url>
		      <loc>'.\$minititolo.'</loc>
		      <lastmod>'.\$lastmod.'</lastmod>
		      <changefreq>daily</changefreq>
		      <priority>0.8</priority>
		   </url>
		   ';
	}

	\$header .= '</urlset>';
	\$sitemapxml=fopen(\$root."sitemap_sezioni.xml","w+");
	fwrite(\$sitemapxml, \$header);
	\$this->disconnettidb();
}

// Crea la sitemap index
public function index_sitemap(\$link,\$root) {
\$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <sitemap>
      <loc>'.\$link.'/sitemap_sezioni.xml</loc>
   </sitemap>
   <sitemap>
      <loc>'.\$link.'/sitemap_aggiuntive.xml</loc>
   </sitemap>
   <sitemap>
      <loc>'.\$link.'/sitemap_news.xml</loc>
   </sitemap>
</sitemapindex>';

\$sitemapxml=fopen(\$root."sitemap.xml","w+");
fwrite(\$sitemapxml, \$sitemap);
}

// Invia la sitemap ai motori di ricerca
public function ping_sitemap(\$link) {
\$google = 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.\$link.'/sitemap.xml';
\$ask = 'http://submissions.ask.com/ping?sitemap='.\$link.'/sitemap.xml';
\$bing = 'http://www.bing.com/webmaster/ping.aspx?siteMap='.\$link.'sitemap.xml';
\$yahoo = 'http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url='.\$link.'sitemap.xml';

\$request0 = file_get_contents(\$google);
\$request = file_get_contents(\$ask);
\$request2 = file_get_contents(\$bing);
\$request3 = file_get_contents(\$yahoo);
}

// Aggiorna la sitemap
// Se \$segnala = 1 ---> la sitemap viene inviata ai motori per file_get-contents, se è 0, invece, non viene inviata.
public function aggiornasitemap(\$link,\$linknews,\$linksezioni,\$root,\$segnala) {
	\$this->news_sitemap(\$linknews,\$root);
	\$this->sezioni_sitemap(\$link,\$linksezioni,\$root);
	\$this->index_sitemap(\$link,\$root);

	if(\$segnala == 1) {
		\$this->ping_sitemap(\$link);
	}
}

/* STATISTICHE */

// Il numero delle sezioni
public function numsezioni() {
	\$this->connettidb();
	\$query = \$this->query("SELECT id FROM pagine");
	\$this->disconnettidb();
	\$num = \$this->conta(\$query);

	if(\$num <= 0) {
		return 0;
	}
	else {
		return \$num;
	}
}

// Il numero delle news
public function numnews() {
	\$this->connettidb();
	\$query = \$this->query("SELECT id FROM news");
	\$this->disconnettidb();
	\$num = \$this->conta(\$query);

	if(\$num <= 0) {
		return 0;
	}
	else {
	return \$num;
	}
}

// Il numero degli utenti
public function numutenti() {
	\$this->connettidb();
	\$query = \$this->query("SELECT id FROM utenti");
	\$this->disconnettidb();
	\$num = \$this->conta(\$query);

	if(\$num <= 0) {
		return 0;
	}
	else{
		return \$num;
	}
}

/* LOG */

// Crea un log
public function log(\$codice, \$azione) {
	// I parametri devono essere già con l'escape!
	\$nickname = \$this->nickname(\$codice);
	\$ip = \$_SERVER['REMOTE_ADDR'];
	\$useragent = \$_SERVER['HTTP_USER_AGENT'];
	\$referer = \$_SERVER['REQUEST_URI'];
	\$data = date("d-m-y");
	\$ora = date("G:i:s");

	\$this->connettidb();
	\$this->query("INSERT INTO log(nickname,azione,ip,data,ora,useragent,referer) VALUES ('\$nickname', '\$azione', '\$ip', '\$data', '\$ora', '\$useragent', '\$referer')");
	\$this->disconnettidb();
}
}
?>
EOF;
	setcookie("host", "", time()-3600);
	setcookie("username", "", time()-3600);
	setcookie("password", "", time()-3600);
	setcookie("database", "", time()-3600);
	echo 'Incolla il codici nel rispettivo file, dopodichè <a href="">cliccami</a>.<br /><br />
<i>/core/class.MySQL.php</i><br />
<textarea style="width:100%;" rows="8">'.$class.'</textarea>';
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1" />
<title>Installer grafico &raquo; Ocarina</title>
<link rel="stylesheet" type="text/css" media="screen,print" href="resources/style.css" />
</head>
<body>

<h1>Ocarina - Installer grafico</h1>
<h2>Installazione terminata</h2>
<p><a href="regutente.php">Clicca qui</a> per registrarti come webmaster, dopodichè elimina la cartella <b>/install/</b>.<br />
Le emoticons e i BBCode le trovi in <b>/core/class.Functions.php</b> e <b>/etc/function.BBCode.php</b>.<br />
Le skin invece si trovano (di default) in <b>/rendering/templates/</b>.<br />
Per inserirne di nuove, utilizza la funzione apposita che trovi nell'amministrazione, per modificarle fai altrettanto.<br />
Per quanto riguarda la skin precaricata (<b>dark</b>), è pronta per essere usata, devi solo modificare le componenti (menù, footer...), sempre con le funzioni appena citate.<br /><br />
Congratulazioni, l'installazione di Ocarina è conclusa con successo!</p>
</body>
</html>
