<?php
/**
	/admin/immagini.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$delete = ((isset($_GET['delete'])) && ($_GET['delete'])) ? $user->purge($_GET['delete']) : '';

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 19).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado < 4) && ($delete == ''))
	$rendering->addValue('immagini', $user->getImage());
elseif(($user->isLogged()) && ($user->username[0]->grado < 4) && ($delete !== ''))
	if($user->deleteImage($user->config[0]->root_immagini.'/'.$delete))
		if(isset($_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.$config[0]->url_admin.'/immagini.php');
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('index.tpl');
