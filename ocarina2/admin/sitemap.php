<?php
/**
	/admin/sitemap.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Page.php');
require_once('../core/class.Comments.php');
require_once('../core/class.Rendering.php');
$submit = isset($_POST['submit']) ? true : false;

$user = new User();
$page = new Page();
$comment = new Comments();
$rendering = new Rendering();

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Amministrazione &raquo; '.$user->config[0]->nomesito);
$rendering->addValue('keywords', $user->config[0]->keywords);
$rendering->addValue('description', $user->config[0]->description);

if(($logged) && ($submit) && (($username[0]->grado < 3) || ($username[0]->grado == 5))) {
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<sitemap>
		<loc>'.$user->config[0]->url_index.'/sitemap_page.xml</loc>
	</sitemap>
	<sitemap>
		<loc>'.$user->config[0]->url_index.'/sitemap_news.xml</loc>
	</sitemap>
	<sitemap>
		<loc>'.$user->config[0]->url_index.'/sitemap_comment.xml</loc>
	</sitemap>
</sitemapindex>';
		$f = fopen($user->config[0]->root_index.'/sitemap.xml', 'w');
		fwrite($f, $sitemap);
		fclose($f);
		$page->sitemapPage();
		$comment->sitemapNews();
		$comment->sitemapComment();
}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('sitemap.tpl');
