<?php
/**
	/admin/cancellaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$minititolo_annuncio = ((isset($_POST['content'])) && (trim($_POST['content']) !== '')) ? $ocarina->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 27).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 2))
	if(!$submit)
		$ocarina->addValue('content', $ocarina->getAd());
	else
		if($minititolo_annuncio !== '')
			if($ocarina->deleteAd($minititolo_annuncio)) {
				$ocarina->addValue('result', $ocarina->getLanguage('deletead', 0));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deleted.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('deletead', 1));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deletion failed.');
			}
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('deletead', 2));
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deletion failed.');
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('whatis', 'annuncio');
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('deletecontent.tpl');
