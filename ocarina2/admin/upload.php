<?php
/**
	/admin/upload.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');
$image = ((isset($_FILES['image'])) && ($_FILES['image'] !== '')) ? $_FILES['image'] : '';
$submit = ($image !== '') ? true : false;
$multiple = ((isset($_GET['multiple'])) && ($_GET['multiple'] !== '') && (is_numeric($_GET['multiple']))) ? (int)$_GET['multiple'] : 1;

$user = new User();
$rendering = new Rendering();

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 23).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado < 4)) {
	if($image !== '')
		if(count($image)-1 < 2)
			if(!$upload = $user->uploadImage($user->config[0]->root_immagini.'/', $image))
				$rendering->addValue('result', $user->getLanguage('upload', 0));
			else
				$rendering->addValue('image', $_FILES['image']['name']);
		else
			if(!$upload = $user->uploadMultipleImage($user->config[0]->root_immagini.'/', $image))
				$rendering->addValue('result', $user->getLanguage('upload', 1));
			else {
				$rendering->addValue('image', $_FILES['image']['name']);
			}
}
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('multiple', $multiple);
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('upload.tpl');
