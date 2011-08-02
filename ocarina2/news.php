<?php
/**
	/news.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.BBCode.php');

$ocarina = new Ocarina();
$bbcode = new BBCode();
$titolo = isset($_GET['titolo']) ? $ocarina->purge($_GET['titolo']) : '';
$ocarinao = isset($_POST['comment']) ? $ocarina->purge($_POST['comment']) : '';

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;

if($titolo == '')
	$ocarina->addValue('error', $ocarina->getLanguage('news', 1));
else {
	if(!$news = $ocarina->getNews($titolo)) {
		$ocarina->addValue('error', $ocarina->getLanguage('news', 2));
		$ocarina->addValue('titolo', $ocarina->config[0]->nomesito);
	}
	else {
		if($ocarina->config[0]->bbcode == 1) {
			$news[0]->contenuto = $bbcode->bbcode($news[0]->contenuto);
			$ocarina->addValue('bbcode', $ocarina->config[0]->bbcode);
		}
		$ocarina->addValue('description', $ocarina->getDescription($news[0]->contenuto));
		$ocarina->addValue('news', $news);
		$ocarina->addValue('titolo', $news[0]->titolo.$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
		
		if(!$getComment = $ocarina->getComment($news[0]->minititolo))
			$ocarina->addValue('commenti', $ocarina->getLanguage('news', 3));
		else {
			if($ocarina->config[0]->bbcode == 1)
				for($i=0, $count=count($getComment); $i<$count; ++$i)
					$getComment[$i]->contenuto = $bbcode->bbcodecommenti($getComment[$i]->contenuto);
			$ocarina->addValue('commenti', $getComment);
		}
		if(($ocarinao !== '') && ($ocarina->isLogged())) {
			$array = ($ocarina->config[0]->approvacommenti == 0) ? array($ocarina->username[0]->nickname, $ocarinao, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 1) : array($ocarina->username[0]->nickname, $ocarinao, $news[0]->minititolo, date('d-m-y'), date('G:m:s'), 0);
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
		elseif(($ocarinao !== '') && (!$ocarina->isLogged()))
			$ocarina->addValue('commentSended', $ocarina->getLanguage('news', 8).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/login.php'));
	}
}
$ocarina->addValue('logged', $ocarina->isLogged());
if($ocarina->isLogged())
	$ocarina->addValue('grado', $ocarina->username[0]->grado);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('news.tpl');
