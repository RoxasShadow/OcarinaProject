<?php
/**
	/errorpage.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$rendering->addValue('utente', $news->isLogged() ? $news->username[0]->nickname : '');
$rendering->skin = $news->isLogged() ? $news->username[0]->skin : $news->config[0]->skin;
$rendering->addValue('titolo', $news->getLanguage('title', 3).$id.$news->getLanguage('title', 2).$news->config[0]->nomesito);
$rendering->addValue('useronline', $news->getUserOnline());
$rendering->addValue('visitatoronline', $news->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $news->getTotalVisits());

if($news->config[0]->log == 1)
	$news->log(($news->isLogged()) ? $news->username[0]->nickname : '~', 'Error '.$id);
$rendering->addValue('id', $id);
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('errorpage.tpl');
