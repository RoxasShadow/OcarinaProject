<?php
/**
	/admin/immagini.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$delete = ((isset($_GET['delete'])) && ($_GET['delete'])) ? $ocarina->purge($_GET['delete']) : '';

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 19).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 4) && ($delete == ''))
	$ocarina->addValue('immagini', $ocarina->getImage());
elseif(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 4) && ($delete !== ''))
	if($ocarina->deleteImage($ocarina->config[0]->root_immagini.'/'.$delete))
		if(isset($_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.$config[0]->url_admin.'/immagini.php');
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('index.tpl');
