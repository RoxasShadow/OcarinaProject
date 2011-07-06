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

if(!$getNews = $news->searchNews(''))
	$rendering->addValue('errore_news', 'È accaduto un errore.');
else
	$rendering->addValue('news', $getNews);
if(!$getPage = $pagine->searchPage('', 'wildcard'))
	$rendering->addValue('errore_pagine', 'È accaduto un errore.');
else
	$rendering->addValue('pagine', $getPage);

(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('archivio.tpl');
