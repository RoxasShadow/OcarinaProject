<?php
/**
	/ricercaa.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.Comments.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$comment = new Comments();
$pagina = new Page();
$rendering = new Rendering();
$config = $comment->getConfig();
$cercaNews = ((isset($_POST['news'])) && (isset($_POST['submitNews']))) ? $comment->purge($_POST['news']) : '';
$cercaPagine = ((isset($_POST['pagine'])) && (isset($_POST['submitPage']))) ? $comment->purge($_POST['pagine']) : '';
$cercaCommenti = ((isset($_POST['commenti'])) && (isset($_POST['submitComment']))) ? $comment->purge($_POST['commenti']) : '';
$cerca = true;

$user = $comment->searchUserByField('secret', $comment->getCookie());
$logged = !$user ? false : true;
$rendering->addValue('utente', $logged ? $user[0]->nickname : '');
$rendering->addValue('titolo', 'Cerca nel sito &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($cercaNews !== '') {
	$search = $comment->searchNews($cercaNews);
	if(!$search)
		$rendering->addValue('error_news', 'Non è stata trovata nessuna news corrispondente alla tua keyword.');
	else
		$rendering->addValue('news', $search);
	$cerca = false;
}
elseif($cercaPagine !== '') {
	$search = $pagina->searchPage($cercaPagine);
	if(!$search)
		$rendering->addValue('error_page', 'Non è stata trovata nessuna pagina corrispondente alla tua keyword.');
	else
		$rendering->addValue('pagina', $search);
	$cerca = false;
}
elseif($cercaCommenti !== '') {
	$search = $comment->searchComment($cercaCommenti);
	if(!$search)
		$rendering->addValue('error_comment', 'Non è stato trovato nessun commento corrispondente alla tua keyword.');
	else
		$rendering->addValue('commento', $search);
	$cerca = false;
}
$rendering->addValue('cerca', $cerca);
$rendering->renderize('ricerca.tpl');
