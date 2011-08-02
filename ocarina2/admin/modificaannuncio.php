<?php
/**
	/admin/modificaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_annuncio = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? $ocarina->purge($_POST['titolo']) : '';
$testo_annuncio = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? $news->purgeSlashes($news->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? $ocarina->purge($_POST['selected']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 28).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 2))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">'.$ocarina->getLanguage('editad', 0).'<select name="selected">';
		if(($allAd = $ocarina->getAd()) !== false)
			foreach($allAd as $v)
				$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		$result .= '</select><input type="submit" name="sel_submit" value="'.$ocarina->getLanguage('title', 28).'" /></form>';
		$ocarina->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$ocarina->addValue('bbcode', 0);
		$ocarina->addValue('nocategory', 1);
		if($this_annuncio = $ocarina->getAd($selected)) {
			$ocarina->addValue('titolo_default', $this_annuncio[0]->titolo);
			$ocarina->addValue('testo', $this_annuncio[0]->contenuto);
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editad', 1));
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_annuncio !== '') && ($testo_annuncio !== '') && ($ocarina->username[0]->grado <= 2)) {
			$this_annuncio = $ocarina->getAd($selected);
			if($ocarina->username[0]->grado < 3)
				if(($ocarina->editAd('titolo', $titolo_annuncio, $this_annuncio[0]->minititolo)) && ($ocarina->editAd('contenuto', $testo_annuncio, $this_annuncio[0]->minititolo)))
					$ocarina->addValue('result', $ocarina->getLanguage('editad', 3));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editad', 4));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('sel', $selected);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
