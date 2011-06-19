<?php
/**
	/pagina.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$config = $pagina->getConfig();
$secret = $pagina->getCookie();
$titolo = isset($_GET['titolo']) ? $pagina->purge($_GET['titolo']) : '';

$user = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);

if($titolo == '')
	$rendering->addValue('error', 'Non è stata selezionata nessuna pagina.');
else
	!$pagina->isPage($titolo) ? $rendering->addValue('contenuto', 'La pagina selezionata non è stata trovata.') : $rendering->addValue('contenuto', $pagina->getPage($titolo));
$rendering->renderize('pagina.tpl');
