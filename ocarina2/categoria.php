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
$categoria = isset($_GET['cat']) ? $news->purge($_GET['cat']) : '';

$rendering->addValue('utente', $news->isLogged() ? $news->username[0]->nickname : '');
$rendering->skin = $news->isLogged() ? $news->username[0]->skin : $news->config[0]->skin;
$rendering->addValue('titolo', $categoria !== '' ? $news->getLanguage('title', 0).$categoria.$news->getLanguage('title', 2).$news->config[0]->nomesito : $news->config[0]->nomesito);
$rendering->addValue('description', $news->getLanguage('description', 1));
$rendering->addValue('useronline', $news->getUserOnline());
$rendering->addValue('visitatoronline', $news->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $news->getTotalVisits());

if($categoria == '')
	$rendering->addValue('error', $news->getLanguage('error', 1));
else {
	if(!$getNewsCat = $news->searchNewsByCategory($categoria))
		$rendering->addValue('error_news', str_replace('{$cat}', $categoria, $news->getLanguage('error', 2)));
	else
		$rendering->addValue('news', $getNewsCat);
	if(!$getPageCat = $pagine->searchPageByCategory($categoria))
		$rendering->addValue('error_page', str_replace('{$cat}', $categoria, $news->getLanguage('error', 3)));
	else
		$rendering->addValue('pagine', $getPageCat);
}
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('archivio.tpl');
