<?php
/**
	/admin/installaskin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
$ocarina = new Ocarina();

$skin = ((isset($_FILES['skin'])) && (trim($_FILES['skin']) !== '')) ? $_FILES['skin'] : '';
$submit = ($skin !== '') ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 32).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && (($ocarina->username[0]->grado == 1) || ($ocarina->username[0]->grado == 4)))
	if($skin !== '')
		if($ocarina->installSkin($ocarina->config[0]->root_rendering.'/templates/', $skin))
			$ocarina->addValue('result', $ocarina->getLanguage('installskin', 0));
		else
			$ocarina->addValue('result', $ocarina->getLanguage('installskin', 1));
	else
		$ocarina->addValue('result', $ocarina->getLanguage('installskin', 1));
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('installaskin.tpl');
