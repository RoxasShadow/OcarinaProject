<?php
/**
	/categoria.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.News.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagine = new Page();
$rendering = new Rendering();
$config = $news->getConfig();
$categoria = isset($_GET['cat']) ? $news->purge($_GET['cat']) : '';

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('titolo', $categoria !== '' ? 'Categoria: '.$categoria.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($categoria == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna categoria.');
else {
	$getNewsCat = $news->searchNewsByCategory($categoria);
	!$getNewsCat ? $rendering->addValue('errore_news', 'Nessuna news è associata alla categoria `'.$categoria.'`.') : $rendering->addValue('news', $getNewsCat);
	$getPageCat = $pagine->searchPageByCategory($categoria);
	!$getPageCat ? $rendering->addValue('errore_pagine', 'Nessuna pagina è associata alla categoria `'.$categoria.'`.') : $rendering->addValue('pagine', $getPageCat);
}
$rendering->renderize('archivio.tpl');
