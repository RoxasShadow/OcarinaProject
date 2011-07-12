<?php
/**
	/pagina.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');
require_once('etc/class.BBCode.php');

$pagina = new Page();
$rendering = new Rendering();
$bbcode = new BBCode();
$titolo = ((isset($_GET['titolo'])) && ($_GET['titolo'] !== '')) ? $pagina->purge($_GET['titolo']) : '';

$rendering->addValue('utente', $pagina->isLogged() ? $pagina->username[0]->nickname : '');
$rendering->skin = $pagina->isLogged() ? $pagina->username[0]->skin : $pagina->config[0]->skin;
$rendering->addValue('titolo', $titolo !== '' ? $titolo.$pagina->getLanguage('title', 2).$pagina->config[0]->nomesito : $pagina->config[0]->nomesito);
$rendering->addValue('useronline', $pagina->getUserOnline());
$rendering->addValue('visitatoronline', $pagina->getVisitatorOnline());

if($titolo == '')
	$rendering->addValue('errore', $pagina->getLanguage('page', 0));
else {
	if(!$getPage = $pagina->getPage($titolo))
		$rendering->addValue('errore', $pagina->getLanguage('page', 1));
	else {
		if($pagina->config[0]->bbcode == 1)
			for($i=0, $count=count($getPage); $i<$count; ++$i)
				$getPage[$i]->contenuto = $bbcode->bbcode($getPage[$i]->contenuto);
		$rendering->addValue('description', $pagina->getDescription($getPage[0]->contenuto));
		$rendering->addValue('pagina', $getPage);
	}
}
(($pagina->isLogged()) && ($pagina->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('pagina.tpl');
