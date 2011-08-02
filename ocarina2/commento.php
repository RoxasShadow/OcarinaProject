<?php
/**
	/commento.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.BBCode.php');

$ocarina = new Ocarina();
$bbcode = new BBCode();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $id !== '' ? str_replace('{$num}', $id, $ocarina->getLanguage('title', 1)).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito : $ocarina->config[0]->nomesito);

if($id == '')
	$ocarina->addValue('error', $ocarina->getLanguage('comment', 0));
else {
	if(!$getComment = $ocarina->searchCommentById($id))
		$ocarina->addValue('error', $ocarina->getLanguage('comment', 1));
	else {
		if($ocarina->config[0]->bbcode == 1)
			$getComment[0]->contenuto = $bbcode->bbcodecommenti($getComment[0]->contenuto);
		$ocarina->addValue('description', $ocarina->getDescription('description', $getComment[0]->contenuto));
		$ocarina->addValue('commento', $getComment);
	}
}
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('commento.tpl');
