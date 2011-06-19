<?php
/**
	/pagina.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$config = $pagina->getConfig();
$titolo = isset($_GET['titolo']) ? $pagina->purge($_GET['titolo']) : '';

$user = $pagina->searchUserByField('secret', $pagina->getCookie());
$logged = !$user ? false : true;
$rendering->addValue('utente', $logged ? $user[0]->nickname : '');
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($titolo == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna pagina.');
else {
	$getPage = $pagina->getPage($titolo); 
	!$getPage ? $rendering->addValue('errore', 'La pagina selezionata non è stata trovata.') : $rendering->addValue('pagina', $getPage);
}
$rendering->renderize('pagina.tpl');
