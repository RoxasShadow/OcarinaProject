<?php
/**
	/errorpage.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';
$found = false;

if($ocarina->getLanguage($id, 0) !== false)
	$found = true;
	
if($found) {
	header("HTTP/1.1 $id {$ocarina->getLanguage($id, 1)}", 1);
	header("HTTP/1.1 $id {$ocarina->getLanguage($id, 1)}", 1);
	$status = $ocarina->getLanguage($id, 2);
	$ocarina->addValue('titolo', $ocarina->getLanguage('title', 3).' '.$id.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
	$ocarina->addValue('id', $id);
	$ocarina->addValue('status', $status);
	if($ocarina->config[0]->log == 1)
		$ocarina->log(($ocarina->isLogged()) ? $ocarina->username[0]->nickname : '~', 'Error '.$id.': '.$status);
}
else {
	$ocarina->addValue('titolo', $ocarina->getLanguage('title', 3).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
	if($ocarina->config[0]->log == 1)
		$ocarina->log(($ocarina->isLogged()) ? $ocarina->username[0]->nickname : '~', 'Error undefined.');
}

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('errorpage.tpl');
