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
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if(($welcome) && ($logged)) {
	$lastlogout = $username[0]->lastlogout;
	if(($lastlogout !== '') && ($lastlogout !== date('d-m-y')))
		$rendering->addValue('lastlogout', $lastlogout);
}
		
$pager = new Pager();
$rendering->addValue('navigatore', $pager->getNav());
$rendering->addValue('currentPage', $pager->getCurrentPage());

if($pager->getCurrentPage() > $pager->getNumPages())
	$rendering->addValue('errore', 'È accaduto un errore.');
else {
	$getNews = $news->getNews('', $pager->getMin(), $pager->getMax());
	if(!$getNews)
		$rendering->addValue('errore', 'È accaduto un errore.');
	elseif($pager->getCurrentPage() == $pager->getNumPages()) {
		for($i=0, $count=count($getNews); $i<$count; ++$i) {
			if($config[0]->limitenews !== 0)
				$getNews[$i]->contenuto = $news->reduceLen($getNews[$i]->contenuto, $config[0]->limitenews, '[br][b][url=news.php?titolo='.$getNews[$i]->minititolo.']Leggi oltre...[/url][/b]');
			$getNews[$i]->contenuto = bbcode($getNews[$i]->contenuto);
		}
		$rendering->addValue('news', $getNews);
	}
	else {
		for($i=0; $i<$pager->getMax(); ++$i) { // È uno spreco di memoria iterare tutti gli elementi, basta iterarne solo quelli che vengono mostrati
			if($config[0]->limitenews !== 0)
			$getNews[$i]->contenuto = $news->reduceLen($getNews[$i]->contenuto, $config[0]->limitenews, '[br][b][url=news.php?titolo='.$getNews[$i]->minititolo.']Leggi oltre...[/url][/b]');
			$getNews[$i]->contenuto = bbcode($getNews[$i]->contenuto);
		}
		$rendering->addValue('news', $getNews);
	}
}
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('index.tpl');
