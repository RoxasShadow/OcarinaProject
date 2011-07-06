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
$rendering->addValue('titolo', $categoria !== '' ? 'Categoria: '.$categoria.' &raquo; '.$news->config[0]->nomesito : $news->config[0]->nomesito);
$rendering->addValue('description', $news->getLanguage('description', 1));

if($categoria == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna categoria.');
else {
	if(!$getNewsCat = $news->searchNewsByCategory($categoria))
		$rendering->addValue('errore_news', 'Nessuna news è associata alla categoria `'.$categoria.'`.');
	else
		$rendering->addValue('news', $getNewsCat);
	if(!$getPageCat = $pagine->searchPageByCategory($categoria))
		$rendering->addValue('errore_pagine', 'Nessuna pagina è associata alla categoria `'.$categoria.'`.');
	else
		$rendering->addValue('pagine', $getPageCat);
}
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('archivio.tpl');
