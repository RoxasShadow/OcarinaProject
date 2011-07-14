<?php
/**
	/admin/modificaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ad.php');
require_once('../core/class.Rendering.php');

$ad = new Ad();
$rendering = new Rendering();
$titolo_annuncio = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($ad->purgeByXSS($_POST['titolo']))) : '';
$testo_annuncio = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($ad->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? htmlentities(addslashes($ad->purgeByXSS($_POST['selected']))) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $ad->isLogged() ? $ad->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $ad->getLanguage('title', 28).$ad->getLanguage('title', 2).$ad->getLanguage('title', 10).$ad->getLanguage('title', 2).$ad->config[0]->nomesito);

if(($ad->isLogged()) && ($ad->username[0]->grado <= 2))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">'.$ad->getLanguage('editad', 0).'<select name="selected">';
		$allAd = $ad->getAd();
		if($allAd !== false)
		foreach($allAd as $v)
			$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		$result .= '</select><input type="submit" name="sel_submit" value="'.$ad->getLanguage('title', 28).'">';
		$rendering->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$rendering->addValue('bbcode', 0);
		$rendering->addValue('nocategory', 1);
		if($this_annuncio = $ad->getAd($selected)) {
			$rendering->addValue('titolo_default', $this_annuncio[0]->titolo);
			$rendering->addValue('testo', $this_annuncio[0]->contenuto);
		}
		else
			$rendering->addValue('result', $ad->getLanguage('editad', 1));
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_annuncio !== '') && ($testo_annuncio !== '') && ($ad->username[0]->grado <= 2)) {
			$this_annuncio = $ad->getAd($selected);
			if($ad->username[0]->grado < 3)
				if(($ad->editAd('titolo', $titolo_annuncio, $this_annuncio[0]->minititolo)) && ($ad->editAd('contenuto', $testo_annuncio, $this_annuncio[0]->minititolo)))
					$rendering->addValue('result', $ad->getLanguage('editad', 3));
		}
		else
			$rendering->addValue('result', $ad->getLanguage('editad', 4));
	}
else
	$rendering->addValue('result', $ad->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
$rendering->addValue('sel', $selected);
(($ad->isLogged()) && ($ad->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
