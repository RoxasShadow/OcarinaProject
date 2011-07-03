<?php
/**
	/news.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Comments.php');
require_once('core/class.Rendering.php');
require_once('etc/class.BBCode.php');

$comment = new Comments();
$rendering = new Rendering();
$bbcode = new BBCode();
$titolo = isset($_GET['titolo']) ? $comment->purge($_GET['titolo']) : '';
$commento = isset($_POST['comment']) ? $comment->purge($_POST['comment']) : '';

$logged = $comment->isLogged() ? true : false;
if($logged)
	$username = $comment->searchUserByField('secret', $comment->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $comment->config[0]->skin;
$rendering->addValue('titolo', $titolo !== '' ? $titolo.' &raquo; '.$comment->config[0]->nomesito : $comment->config[0]->nomesito);
$rendering->addValue('keywords', $comment->config[0]->keywords);
$rendering->addValue('description', $comment->config[0]->description);

if($titolo == '')
	$rendering->addValue('errore', 'Non è stata selezionata nessuna news.');
else {
	if(!$news = $comment->getNews($titolo))
		$rendering->addValue('errore', 'La news selezionata non è stata trovata.');
	else {
		if($comment->config[0]->bbcode == 1) {
			for($i=0, $count=count($news); $i<$count; ++$i)
				$news[$i]->contenuto = $bbcode->bbcode($news[$i]->contenuto);
			$rendering->addValue('bbcode', $comment->config[0]->bbcode);
		}
		$rendering->addValue('news', $news);
		
		if(!$getComment = $comment->getComment($news[0]->minititolo))
			$rendering->addValue('commenti', 'Nessun commento ancora presente.');
		else {
			if($comment->config[0]->bbcode == 1)
				for($i=0, $count=count($getComment); $i<$count; ++$i)
					$getComment[$i]->contenuto = $bbcode->bbcodecommenti($getComment[$i]->contenuto);
			$rendering->addValue('commenti', $getComment);
		}
		if(($commento !== '') && ($logged)) {
			$array = ($comment->config[0]->approvacommenti == 0) ? array($username[0]->nickname, $commento, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 1) : array($username[0]->nickname, $commento, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 0);
			if($comment->config[0]->commenti == 0)
				$rendering->addValue('commentSended', 'I commenti sono attualmente bloccati, attendi per il redirect...'.header('Refresh: 2; URL='.$comment->config[0]->url_index.'/news.php?titolo='.$titolo));
			elseif($comment->createComment($array)) {
				if($comment->config[0]->log == 1)
					$comment->log($username[0]->nickname, 'Comment sended.');
				if($comment->config[0]->sitemap == 1)
					$comment->sitemapComment();
				($comment->config[0]->approvacommenti == 0) ? $rendering->addValue('commentSended', 'Il commento è stato inviato, attendi per il redirect...'.header('Refresh: 2; URL='.$comment->config[0]->url_index.'/news.php?titolo='.$titolo)) : $rendering->addValue('commentSended', 'Il commento è stato inviato ed è in attesa per essere approvato, attendi per il redirect...'.header('Refresh: 2; URL='.$comment->config[0]->url_index.'/news.php?titolo='.$titolo));
			}
			else {
				if($comment->config[0]->log == 1)
					$comment->log($username[0]->nickname, 'Comment was not sended.');
				$rendering->addValue('commentSended', 'È accaduto un errore nell\'invio del commento, attendi per il redirect...'.header('Refresh: 2; URL='.$comment->config[0]->url_index.'/news.php?titolo='.$titolo));
			}
		}
		elseif(($commento !== '') && (!$logged))
			$rendering->addValue('commentSended', 'Solo gli utenti registrati possono commentare le news, attendi per il redirect...'.header('Refresh: 2; URL='.$comment->config[0]->url_index.'/login.php'));
	}
}
$rendering->addValue('logged', $logged);
if($logged)
	$rendering->addValue('grado', $username[0]->grado);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('news.tpl');
