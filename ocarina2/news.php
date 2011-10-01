<?php
/**
	/news.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo = ((isset($_GET['titolo'])) && (trim($_GET['titolo']) !== '')) ? $ocarina->purge($_GET['titolo']) : '';
$comment = ((isset($_GET['comment'])) && (trim($_GET['comment']) !== '')) ? $ocarina->purge($_GET['comment']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;

if($titolo == '') {
	$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
	$ocarina->addValue('error', $ocarina->getLanguage('news', 1));
}
else {
	if(!$news = $ocarina->getNews($titolo)) {
		$ocarina->addValue('error', $ocarina->getLanguage('news', 2));
		$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
	}
	else {
		$ocarina->addValue('description', $ocarina->getDescription($news[0]->contenuto));
		$ocarina->addValue('news', $news);
		$ocarina->addValue('titolo', $news[0]->titolo.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
		
		if(!$getComment = $ocarina->getComment($news[0]->minititolo))
			$ocarina->addValue('commenti', $ocarina->getLanguage('news', 3));
		else
			$ocarina->addValue('commenti', $getComment);
		if(($comment !== '') && ($ocarina->isLogged())) {
			$array = ($ocarina->config[0]->approvacommenti == 0) ? array($ocarina->username[0]->nickname, $comment, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 1) : array($ocarina->username[0]->nickname, $comment, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 0);
			if($ocarina->config[0]->commenti == 0)
				$ocarina->addValue('commentSended', $ocarina->getLanguage('news', 4).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/news/'.$titolo.'.html'));
			elseif($ocarina->createComment($array)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Comment sended.');
				($ocarina->config[0]->approvacommenti == 0) ? $ocarina->addValue('commentSended', $ocarina->getLanguage('news', 5).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/news/'.$titolo.'.html')) : $ocarina->addValue('commentSended', $ocarina->getLanguage('news', 6).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/news/'.$titolo.'.html'));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Comment was not sended.');
				$ocarina->addValue('commentSended', $ocarina->getLanguage('news', 7).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/news/'.$titolo.'.html'));
			}
		}
		elseif(($comment !== '') && (!$ocarina->isLogged()))
			$ocarina->addValue('commentSended', $ocarina->getLanguage('news', 8).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/login.php'));
	}
}
$ocarina->addValue('logged', $ocarina->isLogged());
if($ocarina->isLogged())
	$ocarina->addValue('grado', $ocarina->username[0]->grado);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('news.tpl');
