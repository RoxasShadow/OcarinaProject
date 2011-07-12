<?php
/**
	/vote.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Page.php');
require_once('core/class.News.php');

$page = new Page();
$news = new News();
$action = ((isset($_GET['action'])) && ($_GET['action'] !== '')) ? $page->purge($_GET['action']) : '';
$titolo = ((isset($_GET['titolo'])) && ($_GET['titolo'] !== '')) ? $page->purge($_GET['titolo']) : '';

if($page->isLogged())
	if($action == 'page')
		$page->votePage($titolo);
	elseif($action == 'news')
		$news->voteNews($titolo);

if(isset($_SERVER['HTTP_REFERER']))
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: '.$config[0]->url_index.'/Aindex.php');
