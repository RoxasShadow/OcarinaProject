<?php
/**
	/admin/creapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Page.php');
require_once('../core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$titolo_pagina = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($pagina->purgeByXSS($_POST['titolo']))) : '';
$categoria_pagina = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? htmlentities(addslashes($pagina->purgeByXSS($_POST['categoria']))) : '';
$testo_pagina = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($pagina->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $pagina->isLogged() ? $pagina->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $pagina->getLanguage('title', 16).$pagina->getLanguage('title', 2).$pagina->getLanguage('title', 10).$pagina->getLanguage('title', 2).$pagina->config[0]->nomesito);

if(($pagina->isLogged()) && ($pagina->username[0]->grado <= 3))
	if(!$submit) {
		$rendering->addValue('bbcode', $pagina->config[0]->bbcode);
		$rendering->addValue('categorie', $pagina->getCategory('news'));
	}
	else {
		if(($titolo_pagina !== '') && ($categoria_pagina !== '') && ($testo_pagina !== '')) {
			if($pagina->username[0]->grado == 3)
				$approva_pagina = 0; // non approvato
			else
				$approva_pagina = 1; // approvato
			$array = array($pagina->username[0]->nickname, $titolo_pagina, $pagina->permalink($titolo_pagina), $testo_pagina, $categoria_pagina, date('d-m-y'), date('G:m:i'), $approva_pagina);
			if($pagina->isPage($pagina->permalink($titolo_pagina)))
				$rendering->addValue('result', $pagina->getLanguage('createpage', 0));
			elseif($pagina->createPage($array)) {
				if($approva_pagina == 0)
					$rendering->addValue('result', $pagina->getLanguage('createpage', 1));
				elseif($approva_pagina == 1)
					$rendering->addValue('result', $pagina->getLanguage('createpage', 2));
			}
			else
				$rendering->addValue('result', $pagina->getLanguage('createpage', 3));
		}
		else
			$rendering->addValue('result', $pagina->getLanguage('createpage', 4));
	}
else
	$rendering->addValue('result', $pagina->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($pagina->isLogged()) && ($pagina->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
