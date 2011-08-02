<?php
/**
	/admin/modificagrado.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $ocarina->purgeByXSS($_POST['nickname']) : '';
$grado = ((isset($_POST['grado'])) && ($_POST['grado'] !== '') && (is_numeric($_POST['grado']))) ? (int)$_POST['grado'] : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 21).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1))
	if(!$submit)
		$ocarina->addValue('utenti', $ocarina->getUser());
	else
		if($ocarina->editUser('grado', $grado, $nickname)) {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, $nickname.' now is in the grade '.$grado.'.');
			$ocarina->addValue('result', $ocarina->getLanguage('editgrade', 0));
		}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, $nickname->username[0]->nickname.' has failed to change the grade of '.$nickname.' in '.$grado.'.');
			$ocarina->addValue('result', str_replace('{$nickname}', $nickname, $ocarina->getLanguage('editgrade', 1), $ocarina->getLanguage('editgrade', 0)));
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('modificagrado.tpl');
