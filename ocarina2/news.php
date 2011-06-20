<?php
/**
	/news.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.Comments.php');
require_once('core/class.Rendering.php');
require_once('etc/function.BBCode.php');

$comment = new Comments();
$rendering = new Rendering();
$config = $comment->getConfig();
$titolo = isset($_GET['titolo']) ? $comment->purge($_GET['titolo']) : '';
$commento = isset($_POST['comment']) ? $comment->purge($_POST['comment']) : '';

$logged = $comment->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($titolo == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna news.');
else {
	$news = $comment->getNews($titolo);
	if(!$news)
		$rendering->addValue('errore', 'La news selezionata non è stata trovata.');
	else {
		$getComment = $comment->getComment($news[0]->minititolo);
		for($i=0, $count=count($news); $i<$count; ++$i)
			$news[$i]->contenuto = bbcode($news[$i]->contenuto);
		$rendering->addValue('news', $news);
		
		if(!$getComment)
			$rendering->addValue('commenti', 'Nessun commento ancora presente.');
		else {
			for($i=0, $count=count($getComment); $i<$count; ++$i)
				$getComment[$i]->contenuto = bbcodecommenti($getComment[$i]->contenuto);
			$rendering->addValue('commenti', $getComment);
		}
		if(($commento !== '') && ($logged)) {
			$array = array($user[0]->nickname, $commento, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), $config[0]->approvacommenti);
		if($comment->createComment($array))
			$rendering->addValue('commentSended', 'Il commento è stato inviato, attendi per il redirect...'.header('Refresh: 2; URL=news.php?titolo='.$titolo));
		else
			$rendering->addValue('commentSended', 'È accaduto un errore nell\'invio del commento, attendi per il redirect...'.header('Refresh: 2; URL=news.php?titolo='.$titolo));
		}
		elseif(($commento !== '') && (!$isLogged))
			$rendering->addValue('commentSended', 'Solo gli utenti registrati possono commentare le news, attendi per il redirect...'.header('Refresh: 2; URL=news.php?titolo='.$titolo));
	}
}
$rendering->renderize('news.tpl');
