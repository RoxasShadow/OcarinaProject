<?php
/**
	/ricercaa.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Comments.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagina = new Page();
$comment = new Comments();
$rendering = new Rendering();
$config = $news->getConfig();
$secret = $news->getCookie();
$cercaNews = ((isset($_POST['news'])) && (isset($_POST['submitNews']))) ? $news->purge($_POST['news']) : '';
$cercaPagine = ((isset($_POST['pagine'])) && (isset($_POST['submitPage']))) ? $news->purge($_POST['pagine']) : '';
$cercaCommenti = ((isset($_POST['commenti'])) && (isset($_POST['submitComment']))) ? $news->purge($_POST['commenti']) : '';
$cerca = true;

$user = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', 'Cerca nel sito &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);

if($cercaNews !== '') {
	$search = $news->searchNews($cercaNews);
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








