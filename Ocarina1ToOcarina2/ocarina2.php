<?php
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
/**
	/ocarina2.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
if((!file_exists('news.sql')) || (!file_exists('pages.sql')) || (!file_exists('comments.sql')))
	die('Uno o più file tra `news.sql`, `pages.sql` e `comments.sql` non sono stati trovati o non sono accessibili.'); 
	
/* News */
$handler = fopen('news.sql', 'r');
$news = fread($handler, filesize('news.sql')); 
fclose($handler);

/* Pagine */
$handler = fopen('pages.sql', 'r');
$page = fread($handler, filesize('pages.sql')); 
fclose($handler);

/* Commenti */
$handler = fopen('comments.sql', 'r');
$comments = fread($handler, filesize('comments.sql')); 
fclose($handler);

/* Elaborazione */
$news = unserialize($news);
$page = unserialize($page);
$comments = unserialize($comments);
$news_fail = 0;
$news_ok = 0;
$page_fail = 0;
$page_ok = 0;
$comments_fail = 0;
$comments_ok = 0;
foreach($news as $v) {
	$array = array($v->autore, $ocarina->purgeSlashes($ocarina->purgeByXSS($v->titolo)), $v->minititolo, $ocarina->purgeSlashes($ocarina->purgeByXSS($v->news)), $v->categoria, $v->data, $v->ora, 1);
	if(!$ocarina->isCategory('news', $v->categoria))
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
	$array = array((($v->autore == '') ? $v->autoreultimamodifica : $v->autore), $ocarina->purgeSlashes($ocarina->purgeByXSS($v->titolo)), $v->minititolo, $ocarina->purgeSlashes($ocarina->purgeByXSS($v->contenuto)), $v->categoria, $v->datacreazione, '00:00', 1);
	if(!$ocarina->isCategory('pagine', $v->categoria))
		$ocarina->createCategory('pagine', $v->categoria);
	if($ocarina->isPage($v->minititolo))
		++$page_fail;
	else
		if($ocarina->createPage($array))
			++$page_ok;
		else
			++$page_fail;
}
	
/* Crea un commento senza il controllo dell'esistenza del mittente. */
function createCommentWithoutOwner($ocarina, $array) {
	if(empty($array))
		return false;
	if($ocarina->isNews($array[2])) {
		$query = 'INSERT INTO '.$ocarina->prefix.'commenti(autore, contenuto, news, data, ora, approvato) VALUES(';
		foreach($array as $var)
			$query .= "'$var', ";
		$query = trim($query, ', ');
		$query .= ')';
		return $ocarina->query($query) ? true : false;
	}
	return false;
}

foreach($comments as $v) {
	$array = array($v->nickname, $ocarina->purgeSlashes($ocarina->purgeByXSS($v->testo)), $v->titolo, $v->data, $v->ora, 1);
	if(createCommentWithoutOwner($ocarina, $array))
		++$comments_ok;
	else
		++$comments_fail;
}
unset($ocarina);
die('Su un totale di '.count($news).' news, '.count($comments).' commenti e '.count($page).' pagine:<br />'.$news_ok.' news recuperate e '.$news_fail.' non recuperate;<br />'.$comments_ok.' commenti recuperati e '.$comments_fail.' non recuperati;<br />'.$page_ok.' pagine recuperate e '.$page_fail.' non recuperate.<br />Possibili errori: (mini)titoli duplicati, l\'autore non esiste...<br /><br />If you are satisfied of the result, delete from both Ocarina1 and Ocarina2 the files `news.sql`, `pages.sql`, `comments.sql`, `ocarina1.php` and `ocarina2.php`.<br />2011 (C) Giovanni Capuano <webmaster@giovannicapuano.net>');
?>
