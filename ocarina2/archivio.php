<?php
/**
	/archivio.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagine = new Page();
$rendering = new Rendering();

$rendering->addValue('utente', $news->isLogged() ? $news->username[0]->nickname : '');
$rendering->skin = $news->isLogged() ? $news->username[0]->skin : $news->config[0]->skin;
$rendering->addValue('titolo', 'Archivio &raquo; '.$news->config[0]->nomesito);
$rendering->addValue('description', $news->getLanguage('description', 0));
$rendering->addValue('useronline', $news->getUserOnline());
$rendering->addValue('visitatoronline', $news->getVisitatorOnline());

if(!$getNews = $news->searchNews(''))
	$rendering->addValue('error_news', $news->getLanguage('error', 0));
else
	$rendering->addValue('news', $getNews);
if(!$getPage = $pagine->searchPage('', 'wildcard'))
	$rendering->addValue('error_page', $news->getLanguage('error', 0));
else
	$rendering->addValue('pagine', $getPage);

(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('archivio.tpl');
