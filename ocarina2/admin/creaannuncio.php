<?php
/**
	/admin/creaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ad.php');
require_once('../core/class.Rendering.php');

$ad = new Ad();
$rendering = new Rendering();
$titolo_annuncio = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($ad->purgeByXSS($_POST['titolo']))) : '';
$testo_annuncio = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($ad->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $ad->isLogged() ? $ad->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $ad->getLanguage('title', 26).$ad->getLanguage('title', 2).$ad->getLanguage('title', 10).$ad->getLanguage('title', 2).$ad->config[0]->nomesito);

if(($ad->isLogged()) && ($ad->username[0]->grado <= 2))
	if(!$submit) {
		$rendering->addValue('bbcode', 0);
		$rendering->addValue('nocategory', 1);
	}
	else {
		if(($titolo_annuncio !== '') && ($testo_annuncio !== '')) {
			$array = array($ad->username[0]->nickname, $titolo_annuncio, $ad->permalink($titolo_annuncio), $testo_annuncio, date('d-m-y'), date('G:m:i'));
			if($ad->isAd($ad->permalink($titolo_annuncio)))
				$rendering->addValue('result', $ad->getLanguage('createad', 0));
			elseif($ad->createAd($array))
				$rendering->addValue('result', $ad->getLanguage('createad', 1));
			else
				$rendering->addValue('result', $ad->getLanguage('createad', 2));
		}
		else
			$rendering->addValue('result', $ad->getLanguage('createad', 3));
	}
else
	$rendering->addValue('result', $ad->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($ad->isLogged()) && ($ad->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
