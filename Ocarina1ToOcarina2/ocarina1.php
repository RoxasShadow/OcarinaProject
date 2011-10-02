<?php
/**
	/ocarina1.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('core/class.MySQL.php');
require_once('core/class.Functions.php');
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$db->connettidb();

/* News */
$res = $db->query('SELECT * FROM news') or die('Access to contents failed.');
$news = array();
while($row = mysql_fetch_object($res)) {
	$row->titolo = str_replace(array('&','"','\'','<','>',"\t",), array('&amp;','&quot;','&#039;','&lt;','&gt;','&nbsp;&nbsp;'), $row->titolo);
	$row->news = str_replace(array('&','"','\'','<','>',"\t",), array('&amp;','&quot;','&#039;','&lt;','&gt;','&nbsp;&nbsp;'), $row->news);
	array_push($news, $row);
}
$handler = fopen('news.sql', 'w');
fwrite($handler, serialize($news));
fclose($handler);

/* Pagine */
$res = $db->query('SELECT * FROM pagine') or die('Access to contents failed.');
$pages = array();
while($row = mysql_fetch_object($res)) {
	$row->titolo = str_replace(array('&','"','\'','<','>',"\t",), array('&amp;','&quot;','&#039;','&lt;','&gt;','&nbsp;&nbsp;'), $row->titolo);
	$row->contenuto = str_replace(array('&','"','\'','<','>',"\t",), array('&amp;','&quot;','&#039;','&lt;','&gt;','&nbsp;&nbsp;'), $row->contenuto);
	array_push($pages, $row);
}
$handler = fopen('pages.sql', 'w');
fwrite($handler, serialize($pages));
fclose($handler);

$db->disconnettidb();
unset($func, $db, $cms);
$output = ((file_exists('news.sql')) && (file_exists('pages.sql'))) ? 'Done. Please, run ocarina2.php.' : 'An error has occurred';
die($output);
?>
