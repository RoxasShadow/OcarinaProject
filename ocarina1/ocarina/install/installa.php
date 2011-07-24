<?php
include_once "../core/class.MySQL.php";
$db = new MySQL;

// Creo le query
$database = 'CREATE DATABASE '.$db->database;

$annunci = 'CREATE TABLE IF NOT EXISTS `annunci` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` text NOT NULL,
  `titolo` text NOT NULL,
  `annuncio` text NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$chat = 'CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data` varchar(10) NOT NULL,
  `ora` varchar(8) NOT NULL,
  `datatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nickname` varchar(100) NOT NULL,
  `messaggio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$commenti = 'CREATE TABLE IF NOT EXISTS `commenti` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `autore` varchar(100) NOT NULL,
  `testo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$log = 'CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` text NOT NULL,
  `azione` text NOT NULL,
  `ip` text NOT NULL,
  `data` text NOT NULL,
  `ora` text NOT NULL,
  `useragent` text NOT NULL,
  `referer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$news = 'CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` text NOT NULL,
  `titolo` text NOT NULL,
  `minititolo` text NOT NULL,
  `news` text NOT NULL,
  `categoria` enum(\'Senza categoria\') NOT NULL DEFAULT \'Senza categoria\',
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `dataultimamodifica` varchar(10) NOT NULL,
  `oraultimamodifica` varchar(10) NOT NULL,
  `autoreultimamodifica` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$pagine = 'CREATE TABLE IF NOT EXISTS `pagine` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `minititolo` text NOT NULL,
  `contenuto` text NOT NULL,
  `categoria` enum(\'Senza categoria\') NOT NULL DEFAULT \'Senza categoria\',
  `datacreazione` varchar(10) NOT NULL,
  `dataultimamodifica` varchar(10) NOT NULL,
  `autoreultimamodifica` varchar(100) NOT NULL,
  `autore` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$utenti = 'CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `codice` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grado` enum(\'Webmaster\',\'Editore\',\'Utente\') NOT NULL DEFAULT \'Utente\',
  `dataregistrazione` varchar(10) NOT NULL,
  `avatar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

$temp = 'CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `test` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

// Mi connetto a MySQL
$connessione = mysql_connect($db->host,$db->user,$db->password) or die("Non si è riusciti a connettersi al database.");

// Creo il database
mysql_query($database);

// Ci accedo
$accesso = mysql_select_db($db->database,$connessione);

// Creo le tabelle
mysql_query($annunci);
mysql_query($chat);
mysql_query($commenti);
mysql_query($log);
mysql_query($news);
mysql_query($pagine);
mysql_query($utenti);
mysql_query($temp);

// Effettuo un test
$query = mysql_query("SELECT * FROM annunci");
$query2 = mysql_query("SELECT * FROM chat");
$query3 = mysql_query("SELECT * FROM commenti");
$query4 = mysql_query("SELECT * FROM log");
$query5 = mysql_query("SELECT * FROM news");
$query6 = mysql_query("SELECT * FROM pagine");
$query7 = mysql_query("SELECT * FROM utenti");
$query8 = mysql_query("SELECT * FROM temp");

if(!($query)) {
mysql_close($connessione);
die("La tabella 'annunci' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query2)) {
mysql_close($connessione);
die("La tabella 'chat' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query3)) {
mysql_close($connessione);
die("La tabella 'commenti' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query4)) {
mysql_close($connessione);
die("La tabella 'log' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query5)) {
mysql_close($connessione);
die("La tabella 'news' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query6)) {
mysql_close($connessione);
die("La tabella 'pagine' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query7)) {
mysql_close($connessione);
die("La tabella 'utenti' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

if(!($query8)) {
mysql_close($connessione);
die("La tabella 'temp' non è stata creata correttamente. Controlla i dati in class.MySQL.php");
}

// Mi disconnetto
mysql_close($connessione);

// Redirecto al prossimo passaggio
header("Location: test.php");
?>
