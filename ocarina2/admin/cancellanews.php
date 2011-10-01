<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$minititolo_news = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $ocarina->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 12).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 3))
	if(!$submit)
		$ocarina->addValue('content', $ocarina->searchNews(''));
	else
		if($minititolo_news !== '')
			if($ocarina->deleteNews($minititolo_news)) {
				$ocarina->addValue('result', $ocarina->getLanguage('deletenews', 0));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'News \''.$minititolo_news.'\' deleted.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('deletenews', 1));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
			}
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('deletenews', 2));
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('whatis', 'news');
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('deletecontent.tpl');
