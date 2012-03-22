<?php
/**
	/admin/index.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$ocarina->addValue('nickname', $ocarina->isLogged() ? $ocarina->username[0]->nickname : '');
$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('index.tpl');
