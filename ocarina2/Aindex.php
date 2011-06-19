<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.News.php');
require_once('core/class.Rendering.php');
require_once('etc/class.Pager.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();

$user = $news->searchUserByField('secret', $news->getCookie());
$logged = !$user ? false : true;
$rendering->addValue('utente', $logged ? $user[0]->nickname : '');
$rendering->addValue('titolo', $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

$pager = new Pager();
$rendering->addValue('navigatore', $pager->getNav());
$rendering->addValue('currentPage', $pager->getCurrentPage());

if($pager->getCurrentPage() > $pager->getNumPages())
	$rendering->addValue('errore', 'È accaduto un errore.');
else {
	$getNews = $news->getNews('', $pager->getMin(), $pager->getMax());
	!$getNews ? $rendering->addValue('errore', 'È accaduto un errore.') : $rendering->addValue('news', $getNews);
}

$rendering->renderize('index.tpl');
