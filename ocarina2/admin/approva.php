<?php
/**
	/admin/approva.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Page.php');
require_once('../core/class.Comments.php');
require_once('../core/class.Rendering.php');

$page = new Page();
$comments = new Comments();
$rendering = new Rendering();
$minititolo_news = ((isset($_POST['news'])) && ($_POST['news'] !== '')) ? $news->purgeByXSS($_POST['news']) : '';
$minititolo_pagina = ((isset($_POST['pagina'])) && ($_POST['pagina'] !== '')) ? $news->purgeByXSS($_POST['pagina']) : '';
$id_commento = ((isset($_POST['commento'])) && ($_POST['commento'] !== '') && (is_numeric($_POST['commento']))) ? (int)$_POST['commento'] : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $page->isLogged() ? $page->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $page->getLanguage('title', 11).$page->getLanguage('title', 2).$page->getLanguage('title', 10).$page->getLanguage('title', 2).$comments->config[0]->nomesito);

if(($page->isLogged()) && ($page->username[0]->grado < 3))
	if(!$submit) {
		$rendering->addValue('news', $comments->searchNewsByApprovation());
		$rendering->addValue('pagine', $page->searchPageByApprovation());
		$rendering->addValue('commenti', $comments->searchCommentByApprovation());
	}
	else
		if($minititolo_news !== '')
			if($comments->editNews('approvato', '1', $minititolo_news)) {
				if($comments->config[0]->log == 1)
					$comments->log($page->username[0]->nickname, 'News '.$minititolo_news.' approved.');
				$rendering->addValue('result', $page->getLanguage('approve', 0));
			}
			else {
				if($comments->config[0]->log == 1)
					$comments->log($page->username[0]->nickname, 'News '.$minititolo_news.' approvation failed.');
				$rendering->addValue('result', $page->getLanguage('approve', 1));
			}
		elseif($id_commento !== '')
			if($comments->editComment('approvato', '1', $id_commento)) {
				if($comments->config[0]->log == 1)
					$comments->log($page->username[0]->nickname, 'Comment #'.$id_commento.' approved.');
				$rendering->addValue('result', $page->getLanguage('approve', 2));
			}
			else {
				if($comments->config[0]->log == 1)
					$comments->log($page->username[0]->nickname, 'Comment #'.$id_commento.' approvation failed.');
				$rendering->addValue('result', $page->getLanguage('approve', 3));
			}
		elseif($minititolo_pagina !== '')
			if($page->editPage('approvato', '1', $minititolo_pagina)) {
				if($comments->config[0]->log == 1)
					$comments->log($page->username[0]->nickname, 'Page '.$minititolo_pagina.' approved.');
				$rendering->addValue('result', $page->getLanguage('approve', 4));
			}
			else {
				if($comment->config[0]->log == 1)
					$comment->log($page->username[0]->nickname, 'Page '.$minititolo_pagina.' approvation failed.');
				$rendering->addValue('result', $page->getLanguage('approve', 5));
			}
		else
			$rendering->addValue('result', $page->getLanguage('approve', 6));
else
	$rendering->addValue('result', $page->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($page->isLogged()) && ($page->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('approva.tpl');
