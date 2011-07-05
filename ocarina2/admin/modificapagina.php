<?php
/**
	/admin/modificapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Page.php');
require_once('../core/class.Rendering.php');

$pagina = new Page();
$rendering = new Rendering();
$titolo_pagina = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($pagina->purgeByXSS($_POST['titolo']))) : '';
$categoria_pagina = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? htmlentities(addslashes($pagina->purgeByXSS($_POST['categoria']))) : '';
$testo_pagina = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($pagina->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? htmlentities(addslashes($pagina->purgeByXSS($_POST['selected']))) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $pagina->isLogged() ? $pagina->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Modifica pagina &raquo; Amministrazione &raquo; '.$pagina->config[0]->nomesito);

if(($pagina->isLogged()) && ($pagina->username[0]->grado < 4))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">Scegli la news da modificare <select name="selected">';
		if($pagina->username[0]->grado == 3) {
			$pageByUser = $pagina->searchPageByUser($pagina->username[0]->nickname);
			if($pageByUser !== false)
				foreach($pageByUser as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		elseif($pagina->username[0]->grado < 3) {
			$allPage = $pagina->searchPage('', 'wildcard');
			if($allPage !== false)
			foreach(allPage as $v)
				$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		$result .= '</select><input type="submit" name="sel_submit" value="Modifica news">';
		$rendering->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$rendering->addValue('bbcode', $pagina->config[0]->bbcode);
		$rendering->addValue('categorie', $pagina->getCategory('pagine'));
		if($this_pagina = $pagina->getPage($selected)) {
			$rendering->addValue('titolo_default', $this_pagina[0]->titolo);
			$rendering->addValue('categoria', $this_pagina[0]->categoria);
			$rendering->addValue('testo', $this_pagina[0]->contenuto);
		}
		else
			$rendering->addValue('result', 'È accaduto un errore, la pagina selezionata non esiste.');
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_pagina !== '') && ($categoria_pagina !== '') && ($testo_pagina !== '') && ($pagina->username[0]->grado < 4)) {
			$this_pagina = $pagina->getPage($selected);
			if(($pagina->username[0]->grado == 3) && ($this_pagina[0]->nickname !== $pagina->username[0]->nickname))
				$rendering->addValue('result', 'Non sei abilitato a modificare questa news.');
			elseif((($pagina->username[0]->grado == 3) && ($this_pagina[0]->nickname == $pagina->username[0]->nickname)) || ($pagina->username[0]->grado < 3)) 
				if(($pagina->editPage('titolo', $titolo_pagina, $this_pagina[0]->minititolo)) && ($pagina->editPage('categoria', $categoria_pagina, $this_pagina[0]->minititolo)) && ($pagina->editPage('contenuto', $testo_pagina, $this_pagina[0]->minititolo)) && ($pagina->editPage('dataultimamodifica', date('d-m-y'), $this_pagina[0]->minititolo)) && ($pagina->editPage('oraultimamodifica', date('G:m:i'), $this_pagina[0]->minititolo)) && ($pagina->editPage('autoreultimamodifica', $pagina->username[0]->nickname, $this_pagina[0]->minititolo)))
					$rendering->addValue('result', 'La pagina è stata modificata.');
		}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la modifica della pagina. Controlla di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
$rendering->addValue('sel', $selected);
(($pagina->isLogged()) && ($pagina->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
