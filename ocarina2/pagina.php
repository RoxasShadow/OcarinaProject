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

$logged = $pagina->isLogged() ? true : false;
if($logged)
	$username = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $pagina->config[0]->skin;
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$pagina->config[0]->nomesito : $pagina->config[0]->nomesito);
$rendering->addValue('keywords', $pagina->config[0]->keywords);
$rendering->addValue('description', $pagina->config[0]->description);

if($titolo == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna pagina.');
else {
	if(!$getPage = $pagina->getPage($titolo))
		$rendering->addValue('errore', 'La pagina selezionata non è stata trovata.');
	else {
		if($pagina->config[0]->bbcode == 1)
			for($i=0, $count=count($getPage); $i<$count; ++$i)
				$getPage[$i]->contenuto = $bbcode->bbcode($getPage[$i]->contenuto);
		$rendering->addValue('pagina', $getPage);
	}
}
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('pagina.tpl');
