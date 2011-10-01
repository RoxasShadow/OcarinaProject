<?php
/**
	/admin/modificapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_pagina = ((isset($_POST['titolo'])) && (trim($_POST['titolo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['titolo'])) : '';
$categoria_pagina = ((isset($_POST['categoria'])) && (trim($_POST['categoria']) !== '')) ? $ocarina->purge($_POST['categoria']) : '';
$testo_pagina = ((isset($_POST['testo'])) && (trim($_POST['testo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && (trim($_POST['selected']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['selected'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 23).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 4))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">'.$ocarina->getLanguage('editpage', 0).'<select name="selected">';
		if($ocarina->username[0]->grado == 3) {
			$pageByUser = $ocarina->searchPageByUser($ocarina->username[0]->nickname);
			if($pageByUser !== false)
				foreach($pageByUser as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		elseif($ocarina->username[0]->grado < 3) {
			$allPage = $ocarina->searchPage('', 'wildcard');
			if($allPage !== false)
			foreach($allPage as $v)
				$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		$result .= '</select><input type="submit" name="sel_submit" value="'.$ocarina->getLanguage('title', 23).'" /></form>';
		$ocarina->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$ocarina->addValue('categorie', $ocarina->getCategory('pagine'));
		if($this_pagina = $ocarina->getPage($selected)) {
			$ocarina->addValue('titolo_default', $this_pagina[0]->titolo);
			$ocarina->addValue('categoria', $this_pagina[0]->categoria);
			$ocarina->addValue('testo', $this_pagina[0]->contenuto);
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editpage', 1));
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_pagina !== '') && ($categoria_pagina !== '') && ($testo_pagina !== '') && ($ocarina->username[0]->grado < 4)) {
			$this_pagina = $ocarina->getPage($selected);
			if(($ocarina->username[0]->grado == 3) && ($this_pagina[0]->nickname !== $ocarina->username[0]->nickname))
				$ocarina->addValue('result', $ocarina->getLanguage('editpage', 2));
			elseif((($ocarina->username[0]->grado == 3) && ($this_pagina[0]->nickname == $ocarina->username[0]->nickname)) || ($ocarina->username[0]->grado < 3)) 
				if(($ocarina->editPage('titolo', $titolo_pagina, $this_pagina[0]->minititolo)) && ($ocarina->editPage('categoria', $categoria_pagina, $this_pagina[0]->minititolo)) && ($ocarina->editPage('contenuto', $testo_pagina, $this_pagina[0]->minititolo)) && ($ocarina->editPage('dataultimamodifica', date('d-m-y'), $this_pagina[0]->minititolo)) && ($ocarina->editPage('oraultimamodifica', date('G:m:i'), $this_pagina[0]->minititolo)) && ($ocarina->editPage('autoreultimamodifica', $ocarina->username[0]->nickname, $this_pagina[0]->minititolo)))
					$ocarina->addValue('result', $ocarina->getLanguage('editpage', 3));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editpage', 4));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('sel', $selected);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
