<?php
/**
	/admin/index.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->addValue('nickname', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('index.tpl');
