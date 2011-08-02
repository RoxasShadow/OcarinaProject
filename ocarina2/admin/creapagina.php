<?php
/**
	/admin/creapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_pagina = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['titolo'])) : '';
$categoria_pagina = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? $ocarina->purge($_POST['categoria']) : '';
$testo_pagina = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 17).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 3))
	if(!$submit) {
		$ocarina->addValue('bbcode', $ocarina->config[0]->bbcode);
		$ocarina->addValue('categorie', $ocarina->getCategory('news'));
	}
	else {
		if(($titolo_pagina !== '') && ($categoria_pagina !== '') && ($testo_pagina !== '')) {
			if($ocarina->username[0]->grado == 3)
				$approva_pagina = 0; // non approvato
			else
				$approva_pagina = 1; // approvato
			$array = array($ocarina->username[0]->nickname, $titolo_pagina, $ocarina->permalink($titolo_pagina), $testo_pagina, $categoria_pagina, date('d-m-y'), date('G:m:i'), $approva_pagina);
			if($ocarina->isPage($ocarina->permalink($titolo_pagina)))
				$ocarina->addValue('result', $ocarina->getLanguage('createpage', 0));
			elseif($ocarina->createPage($array)) {
				if($approva_pagina == 0)
					$ocarina->addValue('result', $ocarina->getLanguage('createpage', 1));
				elseif($approva_pagina == 1)
					$ocarina->addValue('result', $ocarina->getLanguage('createpage', 2));
			}
			else
				$ocarina->addValue('result', $ocarina->getLanguage('createpage', 3));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('createpage', 4));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
