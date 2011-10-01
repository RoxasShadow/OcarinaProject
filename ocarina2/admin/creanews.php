<?php
/**
	/admin/creanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_news = ((isset($_POST['titolo'])) && (trim($_POST['titolo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['titolo'])) : '';
$categoria_news = ((isset($_POST['categoria'])) && (trim($_POST['categoria']) !== '')) ? $ocarina->purge($_POST['categoria']) : '';
$testo_news = ((isset($_POST['testo'])) && (trim($_POST['testo']) !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 16).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 3))
	if(!$submit)
		$ocarina->addValue('categorie', $ocarina->getCategory('news'));
	else {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '')) {
			if($ocarina->username[0]->grado == 3)
				$approva_news = 0; // non approvato
			else
				$approva_news = 1; // approvato
			$array = array($ocarina->username[0]->nickname, $titolo_news, $ocarina->permalink($titolo_news), $testo_news, $categoria_news, date('d-m-y'), date('G:m:i'), $approva_news);
			if($ocarina->isNews($ocarina->permalink($titolo_news)))
				$ocarina->addValue('result', $ocarina->getLanguage('createnews', 0));
			elseif($ocarina->createNews($array)) {
				if($approva_news == 0)
					$ocarina->addValue('result', $ocarina->getLanguage('createnews', 1));
				elseif($approva_news == 1)
					$ocarina->addValue('result', $ocarina->getLanguage('createnews', 2));
			}
			else
				$ocarina->addValue('result', $ocarina->getLanguage('createnews', 3));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('createnews', 4));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
