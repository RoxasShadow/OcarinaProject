<?php
/**
	/profilo.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$nickname = ((isset($_GET['nickname'])) && (trim($_GET['nickname']) !== '')) ? $ocarina->purge($_GET['nickname']) : '';
if($nickname == '')
	$nickname = ((isset($_POST['nickname'])) && (trim($_POST['nickname']) !== '')) ? $ocarina->purge($_POST['nickname']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('description', ($nickname !== '') ? $ocarina->getLanguage('description', 6).$nickname.'.' : $ocarina->getLanguage('description', 5));

if($nickname == '') {
	$ocarina->addValue('titolo', $ocarina->getLanguage('profile', 0).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
	$ocarina->addValue('listautenti', $ocarina->getUser());
}
else {
	$ocarina->addValue('titolo', (($ocarina->isLogged()) && ($nickname == $ocarina->username[0]->nickname)) ? $ocarina->getLanguage('profile', 1) : $ocarina->getLanguage('profile', 2).$nickname.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
	$getUser = $ocarina->getUser($nickname);
	$ocarina->addValue('result', $getUser ? $getUser : $ocarina->getLanguage('profile', 3));		
}
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('profilo.tpl');
