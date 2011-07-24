<?php
/**
	/admin/disinstallaskin.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');
$user = new User();
$rendering = new Rendering();

$nomeskin = ((isset($_POST['nomeskin'])) && ($_POST['nomeskin'] !== '')) ? $user->purge($_POST['nomeskin']) : '';
$submit = ($nomeskin !== '') ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 31).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && (($user->username[0]->grado == 1) || ($user->username[0]->grado == 4)))
	if($nomeskin !== '')
		if($rendering->deleteSkin($nomeskin))
			$rendering->addValue('result', $user->getLanguage('removeskin', 0));
		else
			$rendering->addValue('result', $user->getLanguage('removeskin', 1));
	else
			$rendering->addValue('listaskin', $rendering->getSkinList());
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('disinstallaskin.tpl');
