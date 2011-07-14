<?php
/**
	/admin/annunci.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ad.php');
require_once('../core/class.Rendering.php');

$ad = new Ad();
$rendering = new Rendering();
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $ad->isLogged() ? $ad->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $ad->getLanguage('title', 29).$ad->getLanguage('title', 2).$ad->getLanguage('title', 10).$ad->getLanguage('title', 2).$ad->config[0]->nomesito);

if(($ad->isLogged()) && ($ad->username[0]->grado < 6))
	$rendering->addValue('ads', $ad->getAd());
else
	$rendering->addValue('result', $ad->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($ad->isLogged()) && ($ad->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('annunci.tpl');
