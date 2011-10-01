<?php
/**
	/sitemap.php
	(C) Giovanni Capuano 2011
*/
header('Content-Type:text/xml');
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
$content = ((isset($_GET['content'])) && (trim($_GET['content']) !== '')) ? $ocarina->purge($_GET['content']) : '';

if($content == 'page')
	echo $ocarina->sitemapPage();
elseif($content == 'news')
	echo $ocarina->sitemapNews();
elseif($content == 'comment')
	echo $ocarina->sitemapComment();
elseif($content == 'user')
	echo $ocarina->sitemapUser();
else
	echo '<?xml version="1.0" encoding="UTF-8"?>
	<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<sitemap>
			<loc>'.$ocarina->config[0]->url_index.'/sitemap/page.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$ocarina->config[0]->url_index.'/sitemap/news.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$ocarina->config[0]->url_index.'/sitemap/comment.xml</loc>
		</sitemap>
		<sitemap>
			<loc>'.$ocarina->config[0]->url_index.'/sitemap.php/user.xml</loc>
		</sitemap>
	</sitemapindex>';
