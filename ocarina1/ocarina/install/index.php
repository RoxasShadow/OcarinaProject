<?php
if(isset($_POST['invia'])) {
	/* class.MySQL.php */
	$host = $_POST['host'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$database = $_POST['database'];
	setcookie("host", $host);
	setcookie("username", $username);
	setcookie("password", $password);
	setcookie("database", $database);
	$class1 = <<<EOF
<?php
/* Questa classe include tutti i metodi per la gestione del database */
class MySQL {

// Definisco i dati di accesso al db
public \$host='$host'; // L'host del database
public \$user='$username'; // L'username per accedere al database
public \$database='$database'; // Il nome del database
public \$password='$password'; // La password del database
public \$attiva = false;

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

	/* class.Ocarina.php */
	$url = $_POST['url'];
	$url_index = $_POST['url_index'];
	$url_cms = $_POST['url_cms'];
	$url_smartytpl = $_POST['url_smartytpl'];
	$url_immagini = $_POST['url_immagini'];
	$root = $_POST['root'];
	$dir_index = $_POST['dir_index'];
	$dir_cms = $_POST['dir_cms'];
	$dir_smarty = $_POST['dir_smartytpl'];
	$dir_immagini = $_POST['dir_immagini'];
	$nomesito = $_POST['nomesito'];
	$email = $_POST['email'];
	$skin = $_POST['skin'];
	$keywords = $_POST['keywords'];
	$description = $_POST['description'];
	$avanzate = isset($_POST['avanzate']) ? 1 : 0;
	$sitemapgen = isset($_POST['sitemapgen']) ? 1 : 0;
	$sitemapalert = isset($_POST['sitemapalert']) ? 1 : 0;
	$cmslog = isset($_POST['cmslog']) ? 1 : 0;

	if($avanzate == 1) {
		$class2 = '<?php
	class Ocarina {
		public function cmsversion() {
			return \'1.0\';
		}

		public function url() {
			return \''.$url.'\';
		}

		public function url_index() {
			return \''.$url_index.'\';
		}

		public function url_cms() {
			return \''.$url_cms.'\';
		}

		public function url_smartytpl() {
			return \''.$url_smartytpl.'\';
		}

		public function url_immagini() {
			return \''.$url_immagini.'\';
		}
		
		public function root() {
			return \''.$root.'\';
		}
		
		public function dir_index() {
			return \''.$dir_index.'\';
		}
		
		public function dir_cms() {
			return \''.$dir_cms.'\';
		}
		
		public function dir_smarty() {
			return \''.$dir_smarty.'\';
		}
		
		public function dir_immagini() {
			return \''.$dir_immagini.'\';
		}

		public function nomesito() {
			return \''.$nomesito.'\';
		}

		public function email() {
			return \''.$email.'\';
		}

		public function linksezioni() {
			return $this->url_index().\'sezioni.php?titolo=\'; // Non modificare, è per la sitemap!
		}

		public function linknews() {
			return $this->url_index().\'news.php?titolo=\'; // Non modificare, è per la sitemap!
		}

		public function sitemapgen() {
			return '.$sitemapgen.';
		}

		public function sitemapalert() {
			return '.$sitemapalert.';
		}

		public function cmslog() {
			return '.$cmslog.';
		}
	
		public function skin() {
			return \''.$skin.'\'; // Il nome della cartella che contiene la skin del sito.
		}

		public function keywords() {
			return \''.$keywords.'\';
		}

		public function description() {
			return \''.$description.'\';
		}
	}
	?>';
	}
	else {
		$class2 = '<?php
	class Ocarina {
		public function cmsversion() {
			return \'1.0\';
		}

		public function url() {
			return \''.$url.'\';
		}

		public function url_index() {
			return \''.$url_index.'\';
		}

		public function url_cms() {
			return $this->url_index().\'admin/\';
		}

		public function url_smartytpl() {
			return $this->url_index().\'rendering/templates/\';
		}

		public function url_immagini() {
			return $this->url_index().\'immagini/\';
		}
		
		public function root() {
			return getenv("DOCUMENT_ROOT").\'/\';
		}
		
		public function dir_index() {
			return $this->root().\'ocarina/\';
		}
		
		public function dir_cms() {
			return $this->dir_index().\'admin/\';
		}
		
		public function dir_smarty() {
			return $this->dir_index().\'rendering/templates/\';
		}
		
		public function dir_immagini() {
			return $this->dir_index().\'immagini/\';
		}

		public function nomesito() {
			return \''.$nomesito.'\';
		}

		public function email() {
			return \''.$email.'\';
		}

		public function linksezioni() {
			return $this->url_index().\'sezioni.php?titolo=\'; // Non modificare, è per la sitemap!
		}

		public function linknews() {
			return $this->url_index().\'news.php?titolo=\'; // Non modificare, è per la sitemap!
		}

		public function sitemapgen() {
			return '.$sitemapgen.';
		}

		public function sitemapalert() {
			return '.$sitemapalert.';
		}

		public function cmslog() {
			return '.$cmslog.';
		}
	
		public function skin() {
			return \''.$skin.'\'; // Il nome della cartella che contiene la skin del sito.
		}

		public function keywords() {
			return \''.$keywords.'\';
		}

		public function description() {
			return \''.$description.'\';
		}
	}
	?>';
	}
	/* Smarty config */
	if($dir_index !== '') {
		$dir_index2 = $dir_index.'rendering/';
	}
	else {
		$dir_index2 = getenv("DOCUMENT_ROOT").'/ocarina/rendering/';
	}
	$class3 = <<<EOF
<?php
	\$root = '$dir_index2'; // La directory del rendering del cms
	require_once(\$root.'source/Smarty.class.php');
	\$smarty = new Smarty();
	\$smarty->template_dir = \$root.'templates';
	\$smarty->config_dir = \$root.'config';
	\$smarty->compile_dir = \$root.'templates_c';
	\$smarty->cache_dir = \$root.'cache';
	\$templates = \$root.'templates/';
	\$smarty->assign("templates", \$templates); // La diretory dei template
?>
EOF;

	/* class.Functions.php */
	$class4 = '<?php
/* Questa classe include metodi per varie funzioni */
class Functions {

// Definisce il cookie
public function cookie() {
	return \'ocarina-id\'; // Il nome del cookie da assegnare all\'utente per il login (se lo modifichi, i tuoi utenti dovranno riloggarsi per accedere)
}

// Un controllo per verificare se i magic_quotes_gpc sono attivi (1) o meno (0)
public function checkmagicquote() {
	if(!get_magic_quotes_gpc()) {
		$checkmagicquote = 0;
	}
	elseif(get_magic_quotes_gpc()) {
		$checkmagicquote = 1;
	}
	return $checkmagicquote;
}

// Una funzione di escape per le stringhe
public function escape($post) {
	$post = trim($post);
	$post = htmlentities($post);

	if($this->checkmagicquote() == 0) {
		$post = addslashes($post);
		return $post;
	}
	else {
		return $post;
	}
}

// Una funzione per rimuovere gli escape dalle stringhe
public function rescape($post) {
	$post = trim($post);
	$post = stripslashes($post);
	return $post;
}

// Una funzione di escape per le stringhe (news, sezioni e annunci)
public function authescape($post) {
	$post = trim($post);

	if($this->checkmagicquote() == 0) {
		$post = addslashes($post);
		return $post;
	}
	else {
		return $post;
	}
}

// Un controllo del login in base al cookie
public function logged() {
	if(isset($_COOKIE[$this->cookie()])) {
		return 1;
	}
	elseif(!isset($_COOKIE[$this->cookie()])) {
		return 0;
	}
}

// Una funzione di hash
	public function hash($string) {
	$string = md5($string);
	return $string;
}

// Una textarea personalizzata con i BBCode.
// I nuovi BBCode ed eventuali file nell\'head del template (ex: Javascript, CSS) devono essere aggiunti manualmente
// I link delle emoticons qui hanno solo il compito di essere visualizzate nell\'editor, in realtà i link alle vere emoticon
// che si visualizzeranno nel testo si trova in /etc/function.BBCode.php!
public function textareabbcode($name, $testo) {
return <<<EOQ
<script type="text/javascript">
function add(emoticons) {
    var text = document.getElementById("$name").value;
    document.getElementById("$name").value = text + emoticons;
}
function requestcolor() {
    var colore = prompt("Digita il nome del colore (esempio: red, black, white)");
    add(\'[color=\'+colore+\'][/color]\');
}
</script>

<a onclick="javascript:add(\'[b][/b]\');"><b>Grassetto</b></a>
<a onclick="javascript:add(\'[i][/i]\');"><b>Corsivo</b></a>
<a onclick="javascript:add(\'[u][/u]\');"><b>Sottolineato</b></a>
<a onclick="javascript:add(\'[s][/s]\');"><b>Barrato</b></a>
<a onclick="javascript:requestcolor();"><b>Colore</b></a>
<a onclick="javascript:add(\'[url=http://][/url]\');"><b>URL</b></a>
<a onclick="javascript:add(\'[spoiler][/spoiler]\');"><b>Spoiler</b></a>
<a onclick="javascript:add(\'[img][/img]\');"><b>Immagine</b></a>
<a onclick="javascript:add(\'javascript:add(\'[img width= height=][/img]\');\');"><b>Immagine ridimensionata</b></a>
<a onclick="javascript:add(\'[left][/left]\');"><b>Allineato a sinistra</b></a>
<a onclick="javascript:add(\'[center][/center]\');"><b>Allineato a centro</b></a>
<a onclick="javascript:add(\'[right][/right]\');"><b>Allineato a destra</b></a>
<a onclick="javascript:add(\'[summary][/summary]\');"><b>Intestazione</b></a>
<a onclick="javascript:add(\'[br]\');"><b>Accapo</b></a>
<a onclick="javascript:add(\'[code][/code]\');"><b>Codice</b></a>
<a onclick="javascript:add(\'[quote][/quote]\');"><b>Citazione</b></a>
<br />
<img src="'.$url_index.'swanp/wysiwyg/emoticons/nervoso.gif" onclick="javascript:add(\'[nervoso]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/preoccupato.gif" onclick="javascript:add(\'[preoccupato]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/sorridente.gif" onclick="javascript:add(\'[sorridente]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/lingua.gif" onclick="javascript:add(\'[lingua]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/felice.gif" onclick="javascript:add(\'[felice]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/occhiolino.gif" onclick="javascript:add(\'[occhiolino]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/V.gif" onclick="javascript:add(\'[V]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/fg.gif" onclick="javascript:add(\'[fg]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/riot.gif" onclick="javascript:add(\'[riot]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/addit.gif" onclick="javascript:add(\'[addit]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/pwn.gif" onclick="javascript:add(\'[pwn]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/zxc.gif" onclick="javascript:add(\'[zxc]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/argh.gif" onclick="javascript:add(\'[argh]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/look.gif" onclick="javascript:add(\'[look]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/pazzo.gif" onclick="javascript:add(\'[pazzo]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/guru.gif" onclick="javascript:add(\'[guru]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/sisi.gif" onclick="javascript:add(\'[sisi]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/nono.gif" onclick="javascript:add(\'[nono]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/ert.gif" onclick="javascript:add(\'[ert]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/rotfl.gif" onclick="javascript:add(\'[rotfl]\');">
<br />
&lt;textarea id="$name" name="$name" cols="59" rows="10">$testo&lt;/textarea>
EOQ;
}

// Una textarea personalizzata con i BBCode per i commenti
// I nuovi BBCode ed eventuali file nell\'head del template (ex: Javascript, CSS) devono essere aggiunti manualmente
// I link delle emoticons qui hanno solo il compito di essere visualizzate nell\'editor, in realtà i link alle vere emoticon
// che si visualizzeranno nel testo si trova in /etc/function.BBCode.php!
public function textareabbcodecommenti() {
return <<<EOQ
<script type="text/javascript">
function add(emoticons) {
    var text = document.getElementById("txtQuota").value;
    document.getElementById("txtQuota").value = text + emoticons;
}
function requestcolor() {
    var colore = prompt("Digita il nome del colore (esempio: red, black, white)");
    add(\'[color=\'+colore+\'][/color]\');
}
</script>

<a onclick="javascript:add(\'[b][/b]\');"><b>Grassetto</b></a>
<a onclick="javascript:add(\'[i][/i]\');"><b>Corsivo</b></a>
<a onclick="javascript:add(\'[u][/u]\');"><b>Sottolineato</b></a>
<a onclick="javascript:add(\'[s][/s]\');"><b>Barrato</b></a>
<a onclick="javascript:requestcolor();"><b>Colore</b></a>
<a onclick="javascript:add(\'[url=http://][/url]\');"><b>URL</b></a>
<a onclick="javascript:add(\'[spoiler][/spoiler]\');"><b>Spoiler</b></a>
<a onclick="javascript:add(\'[left][/left]\');"><b>Allineato a sinistra</b></a>
<a onclick="javascript:add(\'[center][/center]\');"><b>Allineato a centro</b></a>
<a onclick="javascript:add(\'[right][/right]\');"><b>Allineato a destra</b></a>
<a onclick="javascript:add(\'[br]\');"><b>Accapo</b></a>
<a onclick="javascript:add(\'[code][/code]\');"><b>Codice</b></a>
<a onclick="javascript:add(\'[quote][/quote]\');"><b>Citazione</b></a>
<br />
<img src="'.$url_index.'swanp/wysiwyg/emoticons/nervoso.gif" onclick="javascript:add(\'[nervoso]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/preoccupato.gif" onclick="javascript:add(\'[preoccupato]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/sorridente.gif" onclick="javascript:add(\'[sorridente]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/lingua.gif" onclick="javascript:add(\'[lingua]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/felice.gif" onclick="javascript:add(\'[felice]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/occhiolino.gif" onclick="javascript:add(\'[occhiolino]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/V.gif" onclick="javascript:add(\'[V]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/fg.gif" onclick="javascript:add(\'[fg]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/riot.gif" onclick="javascript:add(\'[riot]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/addit.gif" onclick="javascript:add(\'[addit]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/pwn.gif" onclick="javascript:add(\'[pwn]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/zxc.gif" onclick="javascript:add(\'[zxc]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/argh.gif" onclick="javascript:add(\'[argh]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/look.gif" onclick="javascript:add(\'[look]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/pazzo.gif" onclick="javascript:add(\'[pazzo]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/guru.gif" onclick="javascript:add(\'[guru]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/sisi.gif" onclick="javascript:add(\'[sisi]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/nono.gif" onclick="javascript:add(\'[nono]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/ert.gif" onclick="javascript:add(\'[ert]\');">
<img src="'.$url_index.'swanp/wysiwyg/emoticons/rotfl.gif" onclick="javascript:add(\'[rotfl]\');">
<br />
&lt;textarea name="testo_com" cols="59" rows="10" id="txtQuota" tabindex="1">&lt;/textarea>
EOQ;
}

// Una textarea
public function textarea($name, $testo) {
	return \'&lt;textarea name="\'.$name.\'" cols="59" rows="10" style="height:100%;">\'.$testo.\'&lt;/textarea>\';
}

// Una funzione per pulire il titolo e renderlo minititolo
public function permalink($string) {
	$string = strtolower($string); // Rendo Minuscolo
	$array1 = array("è", "é", "ò", "à", "ù");
	$array2 = array("e", "e", "o", "a", "u");
	$string = str_replace($array1, $array2, $string); // Sostituisce i caratteri accentati con quelli normali
	$string = preg_replace("/[^0-9A-Za-z ]/", "", $string); // Conservo solo lettere e numeri, il resto lo elimino
	$string = str_replace(" ", "-", $string); // Spazi diventano trattini
	while (strstr($string, "--")) {
		$string = preg_replace("/--/", "-", $string);
	}
	return($string);
}

}
?>';

	/* function.BBCode.php */
	$class5 = '&lt;?php
/* Questa classe permette di reversare i BBCode in codice HTML */
function bbcode($txt) {
$cerca_codice= array(
\'/\[b\](.*?)\[\/b\]/is\',
\'/\[i\](.*?)\[\/i\]/is\',
\'/\[u\](.*?)\[\/u\]/is\',
\'/\[s\](.*?)\[\/s\]/is\',
\'/\[color\=(.*?)\](.*?)\[\/color\]/is\',
\'/\[url\=(.*?)\](.*?)\[\/url\]/is\',
\'/\[spoiler\](.*?)\[\/spoiler\]/is\',
\'/\[img\](.*?)\[\/img\]/is\',
\'/\[img width\=(.*?) height\=(.*?)\](.*?)\[\/img\]/is\',
\'/\[center](.*?)\[\/center\]/is\',
\'/\[right](.*?)\[\/right\]/is\',
\'/\[left](.*?)\[\/left\]/is\',
\'/\[summary](.*?)\[\/summary\]/is\',
\'/\[br]/is\',
\'/\[code\](.*?)\[\/code\]/is\',
\'/\[quote](.*?)\[\/quote\]/is\',
\'/\[nervoso\]/is\',
\'/\[preoccupato\]/is\',
\'/\[sorridente\]/is\',
\'/\[lingua\]/is\',
\'/\[felice\]/is\',
\'/\[occhiolino\]/is\',
\'/\[V\]/is\',
\'/\[fg\]/is\',
\'/\[riot\]/is\',
\'/\[addit\]/is\',
\'/\[pwn\]/is\',
\'/\[zxc\]/is\',
\'/\[argh\]/is\',
\'/\[look\]/is\',
\'/\[pazzo\]/is\',
\'/\[guru\]/is\',
\'/\[sisi\]/is\',
\'/\[nono\]/is\',
\'/\[ert\]/is\',
\'/\[rotfl\]/is\',
);
$sostituisci_codice = array(
\'&lt;b>$1&lt;/b>\',
\'&lt;i>$1&lt;/i>\',
\'&lt;u>$1&lt;/u>\',
\'&lt;s>$1&lt;/s>\',
\'&lt;font color="$1">$2&lt;/font>\',
\'&lt;a href="$1">$2&lt;/a>\',
\'&lt;div id="spoiler-dropdown">&lt;a href="#" id="spoiler-head">Mostra/Nascondi&lt;/a>&lt;p class="spoiler round-5" id="spoiler-dialog">$1&lt;/p>&lt;/div>\',
\'&lt;img src="$1">\',
\'&lt;a href="$3">&lt;img src="$3" width="$1" height="$2">&lt;/a>\',
\'&lt;p align="center">$1&lt;/p>\',
\'&lt;p align="right">$1&lt;/p>\',
\'&lt;p align="left">$1&lt;/p>\',
\'&lt;h2>$1&lt;/h2>\',
\'&lt;br />\',
\'&lt;textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1&lt;/textarea>\',
\'&lt;blockquote>&lt;span>$1&lt;/span>&lt;/blockquote>\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/nervoso.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/preoccupato.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/sorridente.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/lingua.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/felice.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/occhiolino.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/V.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/fg.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/riot.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/addit.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/pwn.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/zxc.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/argh.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/look.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/pazzo.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/guru.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/sisi.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/nono.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/ert.png">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/rotfl.gif">\',
);
$txt= preg_replace ($cerca_codice, $sostituisci_codice, $txt);
return $txt;
}

function bbcodecommenti($testo) {
$cerca_codice= array(
\'/\[b\](.*?)\[\/b\]/is\',
\'/\[i\](.*?)\[\/i\]/is\',
\'/\[u\](.*?)\[\/u\]/is\',
\'/\[s\](.*?)\[\/s\]/is\',
\'/\[color\=(.*?)\](.*?)\[\/color\]/is\',
\'/\[url\=(.*?)\](.*?)\[\/url\]/is\',
\'/\[spoiler\](.*?)\[\/spoiler\]/is\',
\'/\[center](.*?)\[\/center\]/is\',
\'/\[right](.*?)\[\/right\]/is\',
\'/\[left](.*?)\[\/left\]/is\',
\'/\[br]/is\',
\'/\[code\](.*?)\[\/code\]/is\',
\'/\[quote](.*?)\[\/quote\]/is\',
\'/\[nervoso\]/is\',
\'/\[preoccupato\]/is\',
\'/\[sorridente\]/is\',
\'/\[lingua\]/is\',
\'/\[felice\]/is\',
\'/\[occhiolino\]/is\',
\'/\[V\]/is\',
\'/\[fg\]/is\',
\'/\[riot\]/is\',
\'/\[addit\]/is\',
\'/\[pwn\]/is\',
\'/\[zxc\]/is\',
\'/\[argh\]/is\',
\'/\[look\]/is\',
\'/\[pazzo\]/is\',
\'/\[guru\]/is\',
\'/\[sisi\]/is\',
\'/\[nono\]/is\',
\'/\[ert\]/is\',
\'/\[rotfl\]/is\',
);
$sostituisci_codice = array(
\'&lt;b>$1&lt;/b>\',
\'&lt;i>$1&lt;/i>\',
\'&lt;u>$1&lt;/u>\',
\'&lt;s>$1&lt;/s>\',
\'&lt;font color="$1">$2&lt;/font>\',
\'&lt;a href="$1">$2&lt;/a>\',
\'&lt;div id="spoiler-dropdown">&lt;a href="#" id="spoiler-head">Mostra/Nascondi&lt;/a>&lt;p class="spoiler round-5" id="spoiler-dialog">$1&lt;/p>&lt;/div>\',
\'&lt;p align="center">$1&lt;/p>\',
\'&lt;p align="right">$1&lt;/p>\',
\'&lt;p align="left">$1&lt;/p>\',
\'&lt;br />\',
\'&lt;textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1&lt;/textarea>\',
\'&lt;blockquote>&lt;span>$1&lt;/span>&lt;/blockquote>\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/nervoso.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/preoccupato.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/sorridente.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/lingua.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/felice.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/occhiolino.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/V.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/fg.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/riot.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/addit.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/pwn.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/zxc.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/argh.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/look.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/pazzo.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/guru.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/sisi.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/nono.gif">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/ert.png">\',
\'&lt;img src="'.$url_index.'swanp/wysiwyg/emoticons/rotfl.gif">\',
);
$testo= preg_replace ($cerca_codice, $sostituisci_codice, $testo);
return $testo;
}
?>';

	echo 'Incolla i codici nei rispettivi file, dopodichè <a href="installa.php">cliccami</a>.<br /><br />

<i>/core/class.MySQL.php</i><br />
<textarea style="width:100%;" rows="8">'.$class1.'</textarea><br /><br />

<i>/core/class.Ocarina.php</i><br />
<textarea style="width:100%;" rows="8">'.$class2.'</textarea><br /><br />

<i>/core/class.Functions.php</i><br />
<textarea style="width:100%;" rows="8">'.$class4.'</textarea><br /><br />

<i>/etc/function.BBCode.php</i><br />
<textarea style="width:100%;" rows="8">'.$class5.'</textarea><br /><br />

<i>/rendering/config.php</i><br />
<textarea style="width:100%;" rows="8">'.$class3.'</textarea>';
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Installer grafico &raquo; Ocarina</title>
<link rel="stylesheet" type="text/css" media="screen,print" href="resources/style.css" />
<script type="text/javascript" src="resources/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="resources/index.js"></script>
</head>
<body>
   
<h1>Ocarina - Installer grafico</h1>
<h2>Sito</h2>
<form onsubmit="return controlla(this)" method="post" action="">
	<div id="sito">
	Nome Sito:<p>Il nome del tuo sito</p><br/>
	<input id="input" type="text" name="nomesito"><br/>
	Email:<p>La tua email</p><br/>
	<input id="input" type="text" name="email"><br/>
	Skin:<p>La skin con cui si visualizza il sito (default: dark)</p><br/>
	<input id="input" type="text" name="skin" value="dark"><br/>
	Chiavi di ricerca <p>Fino a 10 parole chiavi che identificano il tuo sito, separate da una virgola</p><br />
	<input id="input" type="text" name="keywords"><br/>
	Descrizione<p>Una descrizione di massimo 140 caratteri del tuo sito</p><br/>
	<textarea id="input" name="description" rows="5" cols="30"></textarea><br />
	Host database <p>L'host dove risiede il database MySQL (ex.: localhost, sql.miosito.ext)</p><br />
	<input id="input" type="text" name="host"><br/>
	Username database <p>L'username per accedere al database MySQL</p><br />
	<input id="input" type="text" name="username"><br/>
	Password database <p>La password per accedere al database MySQL</p><br />
	<input id="input" type="password" name="password"><br/>
	Database <p>Il nome del database MySQL</p><br />
	<input id="input" type="text" name="database"><br/>
	Url<p>L'url del sito (ex.: http:// www.miosito.com)</p><br/>
	<input id="input"type="text" name="url"><br/>
        Path root<p>L'url della directory del cms (ex.: http:// www.miosito.com/ocarina/) </p><br/>
	<input id="input"type="text" name="url_index"><br/> 
	<input type="checkbox" name="avanzate" onclick="nascondi()" value="avanzate">Avanzate...<p>Nel caso in cui siano state spostate le posizioni delle cartelle</p><br />
        <div id="box">
        Root <p>La root del server (ex.: /var/www/htdocs/)</p><br/>
	<input id="input"type="text" name="root"><br />
	Root Ocarina<p>La root della directory del cms (ex.: /var/www/htdocs/ocarina/)</p><br/>
	<input id="input"type="text" name="dir_index"><br />
	Root Admin<p>La root della directory di amministrazione del cms (ex.: /var/www/htdocs/ocarina/admin/)</p><br/>
	<input id="input"type="text" name="dir_cms"><br />
	Root Template<p>La root della directory dei template del cms (ex.: /var/www/htdocs/ocarina/rendering/templates/)</p><br/>
	<input id="input"type="text" name="dir_smartytpl"><br />
	Root Immagini<p>La root della directory delle immagini (ex.: /var/www/htdocs/ocarina/immagini/)</p><br/>
	<input id="input"type="text" name="dir_immagini"><br />
	Url Admin<p>L'url della directory di amministrazione del cms (ex.: http:// www.miosito.com/ocarina/admin/)</p><br/>
	<input id="input"type="text" name="url_cms"><br />
        Url templates <p>L'url della directory dei templates del cms (ex.: http:// www.miosito.com/ocarina/rendering/templates/)</p><br/>
	<input id="input"type="text" name="url_smartytpl"><br />
	Url immagini<p>L'url della directory delle immagini del cms (ex.: http:// www.miosito.com/ocarina/immagini/)
}</p><br/>
      <input id="input"type="text" name="url_immagini"><br />
        </div>
        <br />
	<input type="checkbox" name="sitemapgen" value ="1" checked> Sitemap automatica (consigliato)<p>Se selezionato la sitema (mappa del sito) verrà generata automaticamente, altrimenti dovrà essere creata manualmente con l'apposito bottone</p><br/>
      
	<input  type="checkbox" name="sitemapalert" value ="1" checked> Notifica Sitemap (consigliato)<p>Se selezionato permette la notifica dell'aggiornamento della sitemap ai motori di ricerca</p><br/>
	<input  type="checkbox" name="cmslog" value ="1" checked> Logs automatici<p> i logs vengono aggiornati ad ogni accesso</p><br/>
	</div>
	<input name="check" type="hidden" value="check" />
	<input id="submit" type="submit" name="invia" value="Crea" onclick="controlform();">
</form>
</body>
</html>
