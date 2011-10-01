<?php
/* AVVIA QUESTO FILE NELLA CARTELLA DI OCARINA2 *DOPO* AVERCI COPIATO IL FILE news.sql E pages.sql */
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();

if((!file_exists('news.sql')) || (!file_exists('pages.sql')))
	die('`news.sql` and/or `pages.sql` have not been found or are not accessible.'); 
$handler = fopen('news.sql', 'r');
$news = fread($handler, filesize('news.sql')); 
fclose($handler);
$handler = fopen('pages.sql', 'r');
$page = fread($handler, filesize('pages.sql')); 
fclose($handler);

$news = unserialize($news);
$page = unserialize($page);
$news_fail = 0;
$news_ok = 0;
$page_fail = 0;
$page_ok = 0;
foreach($news as $v) {
	$array = array($v->autore, $v->titolo, $v->minititolo, $v->news, $v->categoria, $v->data, $v->ora, 1);
	$ocarina->createCategory('news', $v->categoria);
	if($ocarina->isNews($v->minititolo))
		++$news_fail;
	else
		if($ocarina->createNews($array))
			++$news_ok;
		else
			++$news_fail;
}
foreach($page as $v) {
	$array = array($v->autore, $v->titolo, $v->minititolo, $v->contenuto, $v->categoria, $v->datacreazione, '00:00', 1);
	$ocarina->createCategory('pagine', $v->categoria);
	if($ocarina->isPage($v->minititolo))
		++$page_fail;
	else
		if($ocarina->createPage($array))
			++$page_ok;
		else
			++$page_fail;
}
unset($ocarina);
die('Of a total of '.count($news).' news e '.count($page).' pages:<br />'.$news_ok.' news recovered and '.$news_fail.' not recovered.;<br />'.$page_ok.' pages recovered and '.$page_fail.' not recovered.<br />Possible errors: duplicate (mini)title, author does not exist, undefined error...<br /><br />If you are satisfied of the result, delete from both Ocarina1 and Ocarina2 the files `news.sql`, `pages.sql`, `ocarina1.php` and `ocarina2.php`.<br />2011 (C) Giovanni Capuano <webmaster@giovannicapuano.net>');
?>
