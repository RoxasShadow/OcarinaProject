<?php
/**
	/archivio.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.News.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagine = new Page();
$rendering = new Rendering();
$config = $news->getConfig();

$user = $news->searchUserByField('secret', $news->getCookie());
$logged = !$user ? false : true;
$rendering->addValue('utente', $logged ? $user[0]->nickname : '');
$rendering->addValue('titolo', 'Archivio &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

$getNews = $news->getNews();
!$getNews ? $rendering->addValue('errore_news', 'È accaduto un errore.') : $rendering->addValue('news', $getNews);
$getPage = $pagine->getPage();
!$getPage ? $rendering->addValue('errore_pagine', 'È accaduto un errore.') : $rendering->addValue('pagine', $getPage);

$rendering->renderize('archivio.tpl');
