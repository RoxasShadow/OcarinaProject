<?php
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
/**
	/ocarina1.php
	(C) Giovanni Capuano 2011
*/
require_once('core1/class.Ocarina.php');
require_once('core1/class.MySQL.php');
require_once('core1/class.Functions.php');
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$db->connettidb();

/* News */
$res = $db->query('SELECT * FROM news') or die('Accesso alle news fallito.');
$news = array();
while($row = mysql_fetch_object($res)) {
	array_push($news, $row);
}
$handler = fopen('news.sql', 'w');
fwrite($handler, serialize($news));
fclose($handler);

/* Pagine */
$res = $db->query('SELECT * FROM pagine') or die('Accesso alle pagine fallito.');
$pages = array();
while($row = mysql_fetch_object($res)) {
	array_push($pages, $row);
}
$handler = fopen('pages.sql', 'w');
fwrite($handler, serialize($pages));
fclose($handler);

/* Commenti */
$res = $db->query('SELECT * FROM commenti') or die('Accesso ai commenti fallito.');
$comments = array();
while($row = mysql_fetch_object($res)) {
	array_push($comments, $row);
}
$handler = fopen('comments.sql', 'w');
fwrite($handler, serialize($comments));
fclose($handler);

$db->disconnettidb();
unset($func, $db, $cms);
$output = ((file_exists('news.sql')) && (file_exists('pages.sql')) && (file_exists('comments.sql'))) ? 'Fatto. Avvia ora ocarina2.php.' : 'È accaduto un errore.';
die($output);
?>
