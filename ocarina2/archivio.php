<?php
/**
	/categoria.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagine = new Page();
$rendering = new Rendering();
$config = $news->getConfig();
$secret = $news->getCookie();

$user = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', 'Archivio &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);

!$news->getNews() ? $rendering->addValue('news', 'È accaduto un errore.') : $rendering->addValue('news', $news->getNews());
!$pagine->getPage() ? $rendering->addValue('pagine', 'È accaduto un errore.') : $rendering->addValue('pagine', $pagine->getPage());
$rendering->renderize('archivio.tpl');
