<?php
/**
	/admin/disinstallaskin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$nomeskin = ((isset($_POST['nomeskin'])) && ($_POST['nomeskin'] !== '')) ? $ocarina->purge($_POST['nomeskin']) : '';
$submit = ($nomeskin !== '') ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 31).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && (($ocarina->username[0]->grado == 1) || ($ocarina->username[0]->grado == 4)))
	if($nomeskin !== '')
		if($ocarina->deleteSkin($nomeskin))
			$ocarina->addValue('result', $ocarina->getLanguage('removeskin', 0));
		else
			$ocarina->addValue('result', $ocarina->getLanguage('removeskin', 1));
	else
			$ocarina->addValue('listaskin', $ocarina->getSkinList());
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('disinstallaskin.tpl');
