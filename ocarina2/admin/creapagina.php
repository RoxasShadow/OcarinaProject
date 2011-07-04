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

$logged = $pagina->isLogged() ? true : false;
if($logged)
	$username = $pagina->searchUserByField('secret', $pagina->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Crea pagina &raquo; Amministrazione &raquo; '.$pagina->config[0]->nomesito);

if($logged)
	if(!$submit) {
		$rendering->addValue('bbcode', $pagina->config[0]->bbcode);
		$rendering->addValue('categorie', $pagina->getCategory('news'));
	}
	else {
		if(($titolo_pagina !== '') && ($categoria_pagina !== '') && ($testo_pagina !== '') && ($username[0]->grado < 4)) {
			if($username[0]->grado == 3)
				$approva_pagina = 0; // non approvato
			elseif($username[0]->grado < 3)
				$approva_pagina = 1; // approvato
			$array = array($username[0]->nickname, $titolo_pagina, $pagina->permalink($titolo_pagina), $testo_pagina, $categoria_pagina, date('d-m-y'), date('G:m:i'), $approva_pagina);
			if($pagina->isPage($pagina->permalink($titolo_pagina)))
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della pagina. Esiste già una pagina con lo stesso titolo, prova a sceglierne un altro.');
			elseif($pagina->createPage($array)) {
				if($approva_pagina == 0)
					$rendering->addValue('result', 'La pagina è stata creata con successo ed è in attesa di approvazione.');
				elseif($approva_pagina == 1)
					$rendering->addValue('result', 'La pagina è stata creata con successo.');
			}
			else
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della pagina.');
		}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la creazione della pagina. Controlla di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
