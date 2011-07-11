<?php
/**
	/ricerca.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Comments.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$comment = new Comments();
$pagina = new Page();
$rendering = new Rendering();
$cercaNews = ((isset($_POST['news'])) && (isset($_POST['submitNews']))) ? $comment->purge($_POST['news']) : '';
$cercaPagine = ((isset($_POST['pagine'])) && (isset($_POST['submitPage']))) ? $comment->purge($_POST['pagine']) : '';
$cercaCommenti = ((isset($_POST['commenti'])) && (isset($_POST['submitComment']))) ? $comment->purge($_POST['commenti']) : '';
$cerca = true;

$rendering->addValue('utente', $comment->isLogged() ? $comment->username[0]->nickname : '');
$rendering->skin = $comment->isLogged() ? $comment->username[0]->skin : $comment->config[0]->skin;
$rendering->addValue('titolo', 'Cerca nel sito &raquo; '.$comment->config[0]->nomesito);
$rendering->addValue('description', $comment->getLanguage('description', 9));
$rendering->addValue('useronline', $comment->getUserOnline());
$rendering->addValue('visitatoronline', $comment->getVisitatorOnline());

if($cercaNews !== '') {
	if(!$search = $comment->searchNews($cercaNews))
		$rendering->addValue('error_news', 'Non è stata trovata nessuna news corrispondente alla tua keyword.');
	else
		$rendering->addValue('news', $search);
	$cerca = false;
}
elseif($cercaPagine !== '') {
	if(!$search = $pagina->searchPage($cercaPagine, 'wildcard'))
		$rendering->addValue('error_page', 'Non è stata trovata nessuna pagina corrispondente alla tua keyword.');
	else
		$rendering->addValue('pagina', $search);
	$cerca = false;
}
elseif($cercaCommenti !== '') {
	if(!$search = $comment->searchComment($cercaCommenti))
		$rendering->addValue('error_comment', 'Non è stato trovato nessun commento corrispondente alla tua keyword.');
	else
		$rendering->addValue('commento', $search);
	$cerca = false;
}
$rendering->addValue('cerca', $cerca);
(($comment->isLogged()) && ($comment->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('ricerca.tpl');
