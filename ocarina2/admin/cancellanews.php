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

$rendering->addValue('grado', $news->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Cancella news &raquo; Amministrazione &raquo; '.$news->config[0]->nomesito);

if(($news->isLogged()) && ($user->username[0]->grado < 3))
	if(!$submit)
		$rendering->addValue('content', $news->searchNews(''));
	elseif($submit)
		if($minititolo_news !== '')
			if($news->deleteNews($minititolo_news)) {
				$rendering->addValue('result', 'La news è stata cancellata.');
				if($news->config[0]->log == 1)
					$news->log($user->username[0]->nickname, 'News \''.$minititolo_news.'\' deleted.');
			}
			else {
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione della news.');
				if($news->config[0]->log == 1)
					$news->log($user->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
			}
		else {
			$rendering->addValue('result', 'Non sei abilitato a cancellare questa news.');
			if($news->config[0]->log == 1)
				$news->log($user->username[0]->nickname, 'News \''.$minititolo_news.'\' deletion failed.');
		}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'news');
(($news->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
