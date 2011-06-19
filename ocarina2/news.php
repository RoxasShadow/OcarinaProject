<?php
/**
	/news.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Comments.php');
require_once('core/class.Rendering.php');

$comment = new Comments();
$rendering = new Rendering();
$config = $comment->getConfig();
$secret = $comment->getCookie();
$titolo = isset($_GET['titolo']) ? $comment->purge($_GET['titolo']) : '';
$commento = isset($_POST['comment']) ? $comment->purge($_POST['comment']) : '';

$secret = $comment->getCookie();
$user = $comment->searchUserByField('secret', $secret);
$nickname = $user[0]->nickname;
$rendering->addValue('utente', $nickname);
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);
$isLogged = $comment->isLogged($secret);
$rendering->addValue('isLogged', $isLogged);

if($titolo == '')
	$rendering->addValue('error', 'Non è stata selezionata nessuna news.');
else {
	$news = $comment->getNews($titolo);
	if(!$news)
		$rendering->addValue('error', 'La news selezionata non è stata trovata.');
	else {
		$getComment = $comment->getComment($news[0]->minititolo);
		$rendering->addValue('contenuto', $news);
		!$getComment ? $rendering->addValue('comments', 'Nessun commento ancora presente.') : $rendering->addValue('comments', $getComment);
		if(($commento !== '') && ($isLogged)) {
			$array = array($nickname, $commento, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), $config[0]->approvacommenti);
		if($comment->createComment($array))
			$rendering->addValue('commentSended', 'Il commento è stato inviato.');
		else
			$rendering->addValue('commentSended', 'È accaduto un errore nell\'invio del commento.');
		}
		elseif(($commento !== '') && (!$isLogged))
			$rendering->addValue('commentSended', 'Solo gli utenti registrati possono commentare le news.');
	}
}
	
$rendering->renderize('news.tpl');
