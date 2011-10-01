<?php
/**
	/feed.php
	(C) Giovanni Capuano 2011
*/
header('Content-Type:text/xml');
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
$content = ((isset($_GET['content'])) && (trim($_GET['content']) !== '')) ? $ocarina->purge($_GET['content']) : '';

if($content == 'page')
	echo $ocarina->feedPage($ocarina->config[0]->url_index.'/feed/page.html', 0, 10);
elseif($content == 'news')
	echo $ocarina->feedNews($ocarina->config[0]->url_index.'/feeed/news.html', 0, 10);
else
	echo $ocarina->feedNews($ocarina->config[0]->url_index.'/feeed/news.html', 0, 10);
	
