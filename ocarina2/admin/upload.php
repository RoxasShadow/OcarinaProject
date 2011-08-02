<?php
/**
	/admin/upload.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
$image = ((isset($_FILES['image'])) && ($_FILES['image'] !== '')) ? $_FILES['image'] : '';
$submit = ($image !== '') ? true : false;
$multiple = ((isset($_GET['multiple'])) && ($_GET['multiple'] !== '') && (is_numeric($_GET['multiple']))) ? (int)$_GET['multiple'] : 1;

$ocarina = new Ocarina();
$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 25).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 4)) {
	if($image !== '')
		if(count($image)-1 < 2)
			if(!$upload = $ocarina->uploadImage($ocarina->config[0]->root_immagini.'/', $image))
				$ocarina->addValue('result', $ocarina->getLanguage('upload', 0));
			else
				$ocarina->addValue('image', $_FILES['image']['name']);
		else
			if(!$upload = $ocarina->uploadMultipleImage($ocarina->config[0]->root_immagini.'/', $image))
				$ocarina->addValue('result', $ocarina->getLanguage('upload', 1));
			else {
				$ocarina->addValue('image', $_FILES['image']['name']);
			}
	else
		$ocarina->addValue('result', $ocarina->getLanguage('upload', 1));
}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('multiple', $multiple);
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('upload.tpl');
