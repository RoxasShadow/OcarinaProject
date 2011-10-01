<?php
include_once 'core/class.Ocarina.php';
include_once 'core/class.MySQL.php';
include_once 'core/class.Functions.php';
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$db->connettidb();

$res = $db->query('SELECT * FROM news') or die('Access to contents failed.');
$news = array();
while($row = mysql_fetch_object($res))
	array_push($news, $row);
$handler = fopen('news.sql', 'w');
fwrite($handler, serialize($news));
fclose($handler);

$res = $db->query('SELECT * FROM pagine') or die('Access to contents failed.');
$page = array();
while($row = mysql_fetch_object($res))
	array_push($page, $row);
$handler = fopen('pages.sql', 'w');
fwrite($handler, serialize($page));
fclose($handler);

$db->disconnettidb();
unset($func, $db, $cms);
$output = ((file_exists('news.sql')) && (file_exists('pages.sql'))) ? 'Done. Please, run ocarina2.php.' : 'An error has occurred';
die($output);
?>
