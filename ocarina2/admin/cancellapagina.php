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

$rendering->addValue('grado', $pagina->isLogged() ? $pagina->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $pagina->getLanguage('title', 12).$pagina->getLanguage('title', 2).$pagina->getLanguage('title', 10).$pagina->getLanguage('title', 2).$pagina->config[0]->nomesito);

if(($pagina->isLogged()) && ($pagina->username[0]->grado < 3))
	if(!$submit)
		$rendering->addValue('content', $pagina->searchPage('', 'wildcard'));
	else
		if($minititolo_pagina !== '')
			if($pagina->deletePage($minititolo_pagina)) {
				$rendering->addValue('result', $pagina->getLanguage('deletepage', 0));
				if($pagina->config[0]->log == 1)
					$pagina->log($pagina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deleted.');
			}
			else {
				$rendering->addValue('result', $pagina->getLanguage('deletepage', 1));
				if($pagina->config[0]->log == 1)
					$pagina->log($pagina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
			}
		else {
			$rendering->addValue('result', $pagina->getLanguage('deletepage', 2));
			if($pagina->config[0]->log == 1)
				$pagina->log($pagina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
		}
else
	$rendering->addValue('result', $pagina->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'pagina');
(($pagina->isLogged()) && ($pagina->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
