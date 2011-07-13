<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$minititolo_news = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $news->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $news->isLogged() ? $news->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $news->getLanguage('title', 12).$news->getLanguage('title', 2).$news->getLanguage('title', 10).$news->getLanguage('title', 2).$news->config[0]->nomesito);

if(($news->isLogged()) && ($news->username[0]->grado < 3))
	if(!$submit)
		$rendering->addValue('content', $news->searchNews(''));
	else
		if($minititolo_news !== '')
			if($news->deleteNews($minititolo_news)) {
				$rendering->addValue('result', $news->getLanguage('deletenews', 0));
				if($news->config[0]->log == 1)
					$news->log($news->username[0]->nickname, 'News \''.$minititolo_news.'\' deleted.');
			}
			else {
				$rendering->addValue('result', $news->getLanguage('deletenews', 1));
				if($news->config[0]->log == 1)
					$news->log($news->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
			}
		else {
			$rendering->addValue('result', $news->getLanguage('deletenews', 2));
			if($news->config[0]->log == 1)
				$news->log($news->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
		}
else
	$rendering->addValue('result', $news->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'news');
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
