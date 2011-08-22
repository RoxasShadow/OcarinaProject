<?php
/**
	/ricerca.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$cercaNews = (isset($_GET['news'])) ? $ocarina->purge($_GET['news']) : '';
$cercaPagine = (isset($_GET['pagine'])) ? $ocarina->purge($_GET['pagine']) : '';
$cercaCommenti = (isset($_GET['commenti'])) ? $ocarina->purge($_GET['commenti']) : '';
$cerca = true;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 9).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 9));

if($cercaNews !== '') {
	(!$search = $ocarina->searchNews($cercaNews)) ? $ocarina->addValue('error_news', $ocarina->getLanguage('search', 0)) : $ocarina->addValue('news', $search);
	$cerca = false;
}
elseif($cercaPagine !== '') {
	(!$search = $ocarina->searchPage($cercaPagine, 'wildcard')) ? $ocarina->addValue('error_page', $ocarina->getLanguage('search', 1)) : $ocarina->addValue('pagina', $search);
	$cerca = false;
}
elseif($cercaCommenti !== '') {
	(!$search = $ocarina->searchComment($cercaCommenti)) ? $ocarina->addValue('error_comment', $ocarina->getLanguage('search', 2)) : $ocarina->addValue('commento', $search);
	$cerca = false;
}
$ocarina->addValue('cerca', $cerca);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('ricerca.tpl');
