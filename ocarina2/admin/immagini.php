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

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Immagini &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);

if(($logged) && ($username[0]->grado < 4) && ($delete == ''))
	$rendering->addValue('immagini', $user->getImage());
elseif(($logged) && ($delete !== ''))
	if($user->deleteImage($user->config[0]->root_immagini.'/'.$delete))
		if(isset($_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.$config[0]->url_admin.'/immagini.php');
else
	$rendering->addValue('result', 'Accesso negato.');
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('sitemap.tpl');
