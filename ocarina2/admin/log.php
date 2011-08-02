<?php
/**
	/admin/log.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 20).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 6))
	if(!$submit) {
		if($ocarina->config[0]->log == 1)
			$ocarina->log($ocarina->username[0]->nickname, 'Logs readed.');
		$ocarina->addValue('log', $ocarina->getLog());
	}
	else
		if($ocarina->username[0]->grado == 1)
			if($ocarina->deleteLog()) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Logs deleted.');
				$ocarina->addValue('result', $ocarina->getLanguage('log', 0));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Logs deletion failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('log', 1));
			}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Logs deletion failed.');
			$ocarina->addValue('result', $ocarina->getLanguage('log', 2));
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('log.tpl');
