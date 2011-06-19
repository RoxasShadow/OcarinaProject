<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Rendering.php');
require_once('etc/class.Pager.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();
$secret = $news->getCookie();

$user = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);

$pager = new Pager();
$rendering->addValue('navigatore', $pager->getNav());
$rendering->addValue('currentPage', $pager->getCurrentPage());

if($pager->getCurrentPage() > $pager->getNumPages())
	$rendering->addValue('contenuto', 'È accaduto un errore.');
else
	!$news->getNews() ? $rendering->addValue('contenuto', 'È accaduto un errore.') : $rendering->addValue('contenuto', $news->getNews('', $pager->getMin(), $pager->getMax()));
$rendering->renderize('index.tpl');
