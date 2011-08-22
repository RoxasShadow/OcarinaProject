<?php
/**
	/pagina.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.BBCode.php');

$ocarina = new Ocarina();
$bbcode = new BBCode();
$titolo = ((isset($_GET['titolo'])) && ($_GET['titolo'] !== '')) ? $ocarina->purge($_GET['titolo']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;

if($titolo == '') {
	$ocarina->addValue('error', $ocarina->getLanguage('page', 0));
	$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
}
else {
	if(!$getPage = $ocarina->getPage($titolo)) {
		$ocarina->addValue('error', $ocarina->getLanguage('page', 1));
		$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
	}
	else {
		if($ocarina->config[0]->bbcode == 1)
			for($i=0, $count=count($getPage); $i<$count; ++$i)
				$getPage[$i]->contenuto = $bbcode->bbcode($getPage[$i]->contenuto);
		$ocarina->addValue('description', $ocarina->getDescription($getPage[0]->contenuto));
		$ocarina->addValue('pagina', $getPage);
		$ocarina->addValue('titolo', $getPage[0]->titolo !== '' ? $getPage[0]->titolo.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito : $ocarina->config[0]->nomesito);
	}
}
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('pagina.tpl');
