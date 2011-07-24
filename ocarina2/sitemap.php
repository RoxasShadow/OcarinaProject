<?php
/**
	/sitemap.php
	(C) Giovanni Capuano 2011
*/
header('Content-Type:text/xml');
require_once('core/class.Page.php');
require_once('core/class.Comments.php');
$page = new Page();
$comment = new Comments();
$content = ((isset($_GET['content'])) && ($_GET['content'] !== '')) ? $page->purge($_GET['content']) : '';

if($content == 'page')
	echo $page->sitemapPage();
elseif($content == 'news')
	echo $comment->sitemapNews();
elseif($content == 'comment')
	echo $comment->sitemapComment();
elseif($content == 'user')
	echo $comment->sitemapUser();
else
	echo '<?xml version="1.0" encoding="UTF-8"?>
	<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<sitemap>
			<loc>'.$page->config[0]->url_index.'/sitemap/page.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$page->config[0]->url_index.'/sitemap/news.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$page->config[0]->url_index.'/sitemap/comment.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$page->config[0]->url_index.'/sitemap.php/user.xml</loc>
		</sitemap>
	</sitemapindex>';
