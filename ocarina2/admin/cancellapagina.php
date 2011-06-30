<?php
/**
	/admin/cancellapagina.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('../core/class.Page.php');
require_once('../core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$config = $pagina->getConfig();
$minititolo_pagina = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $pagina->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $pagina->isLogged() ? true : false;
if($logged)
	$username = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Cancella pagina &raquo; Amministrazione &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged)
	if(!$submit)
		$rendering->addValue('content', $pagina->searchPage('', 'wildcard'));
	elseif($submit)
		if(($minititolo_pagina !== '') && ($username[0]->grado < 3))
			if($pagina->deletePage($minititolo_pagina))
				$rendering->addValue('result', 'La pagina è stata cancellata.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione della pagina.');
		else
			$rendering->addValue('result', 'Non sei abilitato a cancellare questa pagina.');
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'pagina');
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
