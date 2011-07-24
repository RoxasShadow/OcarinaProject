<?php
/**
	/feed.php
	(C) Giovanni Capuano 2011
*/
header('Content-Type:text/xml');
require_once('core/class.Page.php');
require_once('core/class.Comments.php');
$page = new Page();
$news = new News();
$content = ((isset($_GET['content'])) && ($_GET['content'] !== '')) ? $page->purge($_GET['content']) : '';

if($content == 'page')
	echo $page->feedPage($page->config[0]->url_index.'/feed/page.html', 0, 10);
elseif($content == 'news')
	echo $news->feedNews($page->config[0]->url_index.'/feeed/news.html', 0, 10);
