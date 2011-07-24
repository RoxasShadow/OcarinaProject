<?php
/**
	/admin/cancellaannuncio.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ad.php');
require_once('../core/class.Rendering.php');

$ad = new Ad();
$rendering = new Rendering();
$minititolo_annuncio = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $ad->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $ad->isLogged() ? $ad->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $ad->getLanguage('title', 27).$ad->getLanguage('title', 2).$ad->getLanguage('title', 10).$ad->getLanguage('title', 2).$ad->config[0]->nomesito);

if(($ad->isLogged()) && ($ad->username[0]->grado <= 2))
	if(!$submit)
		$rendering->addValue('content', $ad->getAd());
	else
		if($minititolo_annuncio !== '')
			if($ad->deleteAd($minititolo_annuncio)) {
				$rendering->addValue('result', $ad->getLanguage('deletead', 0));
				if($ad->config[0]->log == 1)
					$ad->log($ad->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deleted.');
			}
			else {
				$rendering->addValue('result', $ad->getLanguage('deletead', 1));
				if($ad->config[0]->log == 1)
					$ad->log($ad->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deletion failed.');
			}
		else {
			$rendering->addValue('result', $ad->getLanguage('deletead', 2));
			if($ad->config[0]->log == 1)
				$ad->log($ad->username[0]->nickname, 'Ad \''.$minititolo_annuncio.'\' deletion failed.');
		}
else
	$rendering->addValue('result', $ad->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'annuncio');
(($ad->isLogged()) && ($ad->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
