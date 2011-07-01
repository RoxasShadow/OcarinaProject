<?php
/**
	/admin/cancellapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Page.php');
require_once('../core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$minititolo_pagina = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $pagina->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $pagina->isLogged() ? true : false;
if($logged)
	$username = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Cancella pagina &raquo; Amministrazione &raquo; '.$pagina->config[0]->nomesito);
$rendering->addValue('keywords', $pagina->config[0]->keywords);
$rendering->addValue('description', $pagina->config[0]->description);

if($logged)
	if(!$submit)
		$rendering->addValue('content', $pagina->searchPage('', 'wildcard'));
	elseif($submit)
		if(($minititolo_pagina !== '') && ($username[0]->grado < 3))
			if($pagina->deletePage($minititolo_pagina)) {
				$rendering->addValue('result', 'La pagina è stata cancellata.');
				if($pagina->config[0]->log == 1)
					$pagina->log($username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deleted.');
			}
			else {
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione della pagina.');
				if($pagina->config[0]->log == 1)
					$pagina->log($username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
			}
		else {
			$rendering->addValue('result', 'Non sei abilitato a cancellare questa pagina.');
			if($pagina->config[0]->log == 1)
				$pagina->log($username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
		}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'pagina');
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
