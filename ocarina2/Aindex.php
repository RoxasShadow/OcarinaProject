<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.News.php');
require_once('core/class.Rendering.php');
require_once('etc/class.Pager.php');
require_once('etc/function.BBCode.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();
$welcome = ((isset($_GET['welcome'])) && ($_GET['welcome'] == 'true')) ? true : false;

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('titolo', $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if(($welcome) && ($logged)) {
	$lastlogout = $username[0]->lastlogout;
	if($lastlogout !== date('d-m-y'))
		$rendering->addValue('lastlogout', $lastlogout);
}
		
$pager = new Pager();
$rendering->addValue('navigatore', $pager->getNav());
$rendering->addValue('currentPage', $pager->getCurrentPage());

if($pager->getCurrentPage() > $pager->getNumPages())
	$rendering->addValue('errore', 'È accaduto un errore.');
else {
	$max = $pager->getMax();
	$getNews = $news->getNews('', $pager->getMin(), $max);
	if(!$getNews)
		$rendering->addValue('errore', 'È accaduto un errore.');
	else {
		for($i=0; $i<$max; ++$i) // È uno spreco di memoria iterare tutti gli elementi, basta iterarne solo quelli che vengono mostrati
			$getNews[$i]->contenuto = bbcode($getNews[$i]->contenuto);
		$rendering->addValue('news', $getNews);
	}
}
$rendering->renderize('index.tpl');
