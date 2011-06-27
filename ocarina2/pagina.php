<?php
/**
	/pagina.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');
require_once('etc/function.BBCode.php');

$pagina = new Page();
$rendering = new Rendering();
$config = $pagina->getConfig();
$titolo = ((isset($_GET['titolo'])) && ($_GET['titolo'] !== '')) ? $pagina->purge($_GET['titolo']) : '';

$logged = $pagina->isLogged() ? true : false;
if($logged)
	$username = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $config[0]->skin;
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($titolo == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna pagina.');
else {
	if(!$getPage = $pagina->getPage($titolo))
		$rendering->addValue('errore', 'La pagina selezionata non è stata trovata.');
	else {
		if($config[0]->bbcode == 1)
			for($i=0, $count=count($getPage); $i<$count; ++$i)
				$getPage[$i]->contenuto = bbcode($getPage[$i]->contenuto);
		$rendering->addValue('pagina', $getPage);
	}
}
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('pagina.tpl');
