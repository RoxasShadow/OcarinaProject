<?php
/**
	/admin/creaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_annuncio = ((isset($_POST['titolo'])) && (trim($_POST['titolo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['titolo'])) : '';
$testo_annuncio = ((isset($_POST['testo'])) && (trim($_POST['testo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 26).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 2))
	if(!$submit) {
		$ocarina->addValue('bbcode', 0);
		$ocarina->addValue('nocategory', 1);
	}
	else {
		if(($titolo_annuncio !== '') && ($testo_annuncio !== '')) {
			$array = array($ocarina->username[0]->nickname, $titolo_annuncio, $ocarina->permalink($titolo_annuncio), $testo_annuncio, date('d-m-y'), date('G:m:i'));
			if($ocarina->isAd($ocarina->permalink($titolo_annuncio)))
				$ocarina->addValue('result', $ocarina->getLanguage('createad', 0));
			elseif($ocarina->createAd($array))
				$ocarina->addValue('result', $ocarina->getLanguage('createad', 1));
			else
				$ocarina->addValue('result', $ocarina->getLanguage('createad', 2));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('createad', 3));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
