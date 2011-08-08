<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.Pager.php');
require_once('etc/class.BBCode.php');

$ocarina = new Ocarina();
$bbcode = new BBCode();
$pager = new Pager($ocarina->countNews(), $ocarina->config[0]->impaginazionenews);
$welcome = ((isset($_GET['welcome'])) && ($_GET['welcome'] == 'true')) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->config[0]->description);

if(($welcome) && ($ocarina->isLogged()))
	if(($ocarina->username[0]->lastlogout !== '') && ($ocarina->username[0]->lastlogout !== date('d-m-y')))
		$ocarina->addValue('lastlogout', $ocarina->username[0]->lastlogout);

$ocarina->addValue('navigatore', $pager->getNav());
$ocarina->addValue('currentPage', $pager->currentPage);

if($pager->currentPage > $pager->numPages)
	$ocarina->addValue('error', $ocarina->getLanguage('error', 0));
else {
	if(!$getNews = $ocarina->getNews('', $pager->min, $pager->max))
		$ocarina->addValue('error', $ocarina->getLanguage('error', 0));
	elseif($pager->currentPage == $pager->numPages) {
		for($i=0, $count=count($getNews); $i<$count; ++$i) {
			if($ocarina->config[0]->limitenews !== 0)
				$getNews[$i]->contenuto = $ocarina->reduceLen($getNews[$i]->contenuto, $ocarina->config[0]->limitenews, '[br][b][url='.$ocarina->config[0]->url_index.'/news/'.$getNews[$i]->minititolo.'.html]'.$ocarina->getLanguage('news', 0).'[/url][/b]');
			$getNews[$i]->contenuto = $bbcode->bbcode($getNews[$i]->contenuto);
		}
		$ocarina->addValue('news', $getNews);
	}
	else {
		for($i=0; $i<$pager->max; ++$i) { // È uno spreco di tempo iterare tutti gli elementi, basta iterarne solo quelli che vengono mostrati
			if($ocarina->config[0]->limitenews !== 0)
				$getNews[$i]->contenuto = $ocarina->reduceLen($getNews[$i]->contenuto, $ocarina->config[0]->limitenews, '[br][b][url='.$ocarina->config[0]->url_index.'/news/'.$getNews[$i]->minititolo.'.html]'.$ocarina->getLanguage('news', 0).'[/url][/b]');
			$getNews[$i]->contenuto = $bbcode->bbcode($getNews[$i]->contenuto);
		}
		$ocarina->addValue('news', $getNews);
	}
}
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('index.tpl');
