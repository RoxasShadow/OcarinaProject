<?php
/**
	/archivio.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', 'Archivio &raquo; '.$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 0));

(!$getNews = $ocarina->searchNews('')) ? $ocarina->addValue('error_news', $ocarina->getLanguage('error', 0)) : $ocarina->addValue('news', $getNews);
(!$getPage = $ocarina->searchPage('', 'wildcard')) ? $ocarina->addValue('error_page', $ocarina->getLanguage('error', 0)) : $ocarina->addValue('pagine', $getPage);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('archivio.tpl');
