<?php
/**
	/mp.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 33).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(!$ocarina->isLogged())
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
elseif($id == '')
	$ocarina->addValue('result', $ocarina->getPM('', $ocarina->username[0]->nickname));
else {
	$yourPM = $ocarina->getPM($id);
	if($yourPM[0]->destinatario == $ocarina->username[0]->nickname) {
		$ocarina->addValue('result', $yourPM);
		$ocarina->readedPM($id);
	}
}
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('id', $id);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('mp.tpl');
