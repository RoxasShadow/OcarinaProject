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

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', 'Archivio &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if(!$getNews = $news->getNews())
	$rendering->addValue('errore_news', 'È accaduto un errore.');
else
	$rendering->addValue('news', $getNews);
if(!$getPage = $pagine->getPage())
	$rendering->addValue('errore_pagine', 'È accaduto un errore.');
else
	$rendering->addValue('pagine', $getPage);

(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('archivio.tpl');
