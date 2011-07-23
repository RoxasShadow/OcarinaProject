<?php
/**
	/admin/installaskin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');
$user = new User();
$rendering = new Rendering();

$skin = ((isset($_FILES['skin'])) && ($_FILES['skin'] !== '')) ? $_FILES['skin'] : '';
$submit = ($skin !== '') ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 32).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && (($user->username[0]->grado == 1) || ($user->username[0]->grado == 4)))
	if($skin !== '')
		if($rendering->installSkin($user->config[0]->root_rendering.'/templates/', $skin))
			$rendering->addValue('result', $user->getLanguage('installskin', 0));
		else
			$rendering->addValue('result', $user->getLanguage('installskin', 1));
	else
		$rendering->addValue('result', $user->getLanguage('installskin', 1));
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('installaskin.tpl');
