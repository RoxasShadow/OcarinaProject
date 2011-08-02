<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Rendering.php');
require_once('etc/class.NewsPager.php');
require_once('etc/class.BBCode.php');

$news = new News();
$rendering = new Rendering();
$bbcode = new BBCode();
$welcome = ((isset($_GET['welcome'])) && ($_GET['welcome'] == 'true')) ? true : false;

$rendering->addValue('utente', $news->isLogged() ? $news->username[0]->nickname : '');
$rendering->skin = $news->isLogged() ? $news->username[0]->skin : $news->config[0]->skin;
$rendering->addValue('titolo', $news->config[0]->nomesito);
$rendering->addValue('description', $news->config[0]->description);
$rendering->addValue('useronline', $news->getUserOnline());
$rendering->addValue('visitatoronline', $news->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $news->getTotalVisits());
require_once('core/class.PersonalMessage.php');
$pm = new PersonalMessage();
$rendering->addValue('numeromp', $pm->countPM());
unset($pm);

if(($welcome) && ($news->isLogged()))
	if(($news->username[0]->lastlogout !== '') && ($news->username[0]->lastlogout !== date('d-m-y')))
		$rendering->addValue('lastlogout', $news->username[0]->lastlogout);
		
$pager = new NewsPager($news->config[0]->impaginazionenews);
$rendering->addValue('navigatore', $pager->getNav());
$rendering->addValue('currentPage', $pager->currentPage);

if($pager->currentPage > $pager->numPages)
	$rendering->addValue('error', $news->getLanguage('error', 0));
else {
	if(!$getNews = $news->getNews('', $pager->min, $pager->max))
		$rendering->addValue('error', $news->getLanguage('error', 0));
	elseif($pager->currentPage == $pager->numPages) {
		for($i=0, $count=count($getNews); $i<$count; ++$i) {
			if($news->config[0]->limitenews !== 0)
				$getNews[$i]->contenuto = $news->reduceLen($getNews[$i]->contenuto, $news->config[0]->limitenews, '[br][b][url='.$news->config[0]->url_index.'/news/'.$getNews[$i]->minititolo.'.html]'.$news->getLanguage('news', 0).'[/url][/b]');
			$getNews[$i]->contenuto = $bbcode->bbcode($getNews[$i]->contenuto);
		}
		$rendering->addValue('news', $getNews);
	}
	else {
		for($i=0; $i<$pager->max; ++$i) { // È uno spreco di tempo iterare tutti gli elementi, basta iterarne solo quelli che vengono mostrati
			if($news->config[0]->limitenews !== 0)
				$getNews[$i]->contenuto = $news->reduceLen($getNews[$i]->contenuto, $news->config[0]->limitenews, '[br][b][url='.$news->config[0]->url_index.'/news/'.$getNews[$i]->minititolo.'.html]'.$news->getLanguage('news', 0).'[/url][/b]');
			$getNews[$i]->contenuto = $bbcode->bbcode($getNews[$i]->contenuto);
		}
		$rendering->addValue('news', $getNews);
	}
}
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('index.tpl');
