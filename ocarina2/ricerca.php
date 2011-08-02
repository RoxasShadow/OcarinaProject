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
$rendering->addValue('titolo', $comment->getLanguage('title', 9).$comment->getLanguage('title', 2).$comment->config[0]->nomesito);
$rendering->addValue('description', $comment->getLanguage('description', 9));
$rendering->addValue('useronline', $comment->getUserOnline());
$rendering->addValue('visitatoronline', $comment->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $comment->getTotalVisits());
require_once('core/class.PersonalMessage.php');
$pm = new PersonalMessage();
$rendering->addValue('numeromp', $pm->countPM());
unset($pm);

if($cercaNews !== '') {
	(!$search = $comment->searchNews($cercaNews)) ? $rendering->addValue('error_news', $comment->getLanguage('search', 0)) : $rendering->addValue('news', $search);
	$cerca = false;
}
elseif($cercaPagine !== '') {
	(!$search = $pagina->searchPage($cercaPagine, 'wildcard')) ? $rendering->addValue('error_page', $comment->getLanguage('search', 1)) : $rendering->addValue('pagina', $search);
	$cerca = false;
}
elseif($cercaCommenti !== '') {
	(!$search = $comment->searchComment($cercaCommenti)) ? $rendering->addValue('error_comment', $comment->getLanguage('search', 2)) : $rendering->addValue('commento', $search);
	$cerca = false;
}
$rendering->addValue('cerca', $cerca);
(($comment->isLogged()) && ($comment->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('ricerca.tpl');
