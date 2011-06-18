<?php
/**
	/index.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();
$secret = $news->getCookie();

$user = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

$totale = $news->countNews();
$max = $config[0]->limitenews;
$currentPage = ((!isset($_GET['p'])) || (isset($_GET['p']) && intval($_GET['p']) <= 1))  ? 1 : intval($_GET['p']);
$numPages = ceil($totale / $max);
$min = ($currentPage - 1) * $max;
$nav = array();
for($i=1; $i<=$numPages; $i++)
	$nav[$i] = $i;
$rendering->addValue('navigatore', $nav);
$rendering->addValue('currentPage', $currentPage);

!$news->getNews() ? $rendering->addValue('contenuto', 'È accaduto un errore.') : $rendering->addValue('contenuto', $news->getNews('', $min, $max));
$rendering->renderize('index.tpl');
