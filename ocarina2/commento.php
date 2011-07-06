<?php
/**
	/commento.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Comments.php');
require_once('core/class.Rendering.php');
require_once('etc/class.BBCode.php');

$comments = new Comments();
$rendering = new Rendering();
$bbcode = new BBCode();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$rendering->addValue('utente', $comments->isLogged() ? $comments->username[0]->nickname : '');
$rendering->skin = $comments->isLogged() ? $comments->username[0]->skin : $comments->config[0]->skin;
$rendering->addValue('titolo', $id !== '' ? 'Commento numero #'.$id.' &raquo; '.$comments->config[0]->nomesito : $comments->config[0]->nomesito);

if($id == '')
	$rendering->addValue('errore', 'Non è stato selezionato nessun commento.');
else {
	if(!$getComment = $comments->searchCommentById($id))
		$rendering->addValue('errore', 'Il commento selezionato non è stato trovato.');
	else {
		if($comments->config[0]->bbcode == 1)
			for($i=0, $count=count($getComment); $i<$count; ++$i)
				$getComment[$i]->contenuto = $bbcode->bbcodecommenti($getComment[$i]->contenuto);
		$rendering->addValue('description', $comments->getDescription('description', $getComment[0]->contenuto));
		$rendering->addValue('commento', $getComment);
	}
}
(($comments->isLogged()) && ($comments->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('commento.tpl');
