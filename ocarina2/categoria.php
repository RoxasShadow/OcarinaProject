<?php
/**
	/categoria.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
$categoria = ((isset($_GET['cat'])) && (trim($_GET['cat']) !== '')) ? $ocarina->purge($_GET['cat']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $categoria !== '' ? $ocarina->getLanguage('title', 0).$categoria.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito : $ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 1));

if($categoria == '')
	$ocarina->addValue('error', $ocarina->getLanguage('error', 1));
else {
	(!$getNewsCat = $ocarina->searchNewsByCategory($categoria)) ? $ocarina->addValue('error_news', str_replace('{$cat}', $categoria, $ocarina->getLanguage('error', 2))) : $ocarina->addValue('news', $getNewsCat);
	(!$getPageCat = $ocarina->searchPageByCategory($categoria)) ? $ocarina->addValue('error_page', str_replace('{$cat}', $categoria, $ocarina->getLanguage('error', 3))) : $ocarina->addValue('pagine', $getPageCat);
}
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('archivio.tpl');
