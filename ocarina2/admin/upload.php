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

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Upload &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);

if(($logged) && ($username[0]->grado < 4)) {
	if($image !== '')
		if(count($image)-1 < 2)
			if(!$upload = $user->uploadImage($user->config[0]->root_immagini.'/', $image))
				$rendering->addValue('result', 'È accaduto un errore durante il caricamento del file nel server.');
			else
				$rendering->addValue('image', $_FILES['image']['name']);
		else
			if(!$upload = $user->uploadMultipleImage($user->config[0]->root_immagini.'/', $image))
				$rendering->addValue('result', 'È accaduto un errore durante il caricamento dei file nel server.');
			else {
				$rendering->addValue('image', $_FILES['image']['name']);
			}
}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('multiple', $multiple);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('upload.tpl');
