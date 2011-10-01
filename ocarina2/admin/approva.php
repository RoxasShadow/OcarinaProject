<?php
/**
	/admin/approva.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$minititolo_news = ((isset($_POST['news'])) && (trim($_POST['news']) !== '')) ? $ocarina->purgeByXSS($_POST['news']) : '';
$minititolo_pagina = ((isset($_POST['pagina'])) && (trim($_POST['pagina']) !== '')) ? $ocarina->purgeByXSS($_POST['pagina']) : '';
$id_commento = ((isset($_POST['commento'])) && (trim($_POST['commento']) !== '') && (is_numeric($_POST['commento']))) ? (int)$_POST['commento'] : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 11).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 3))
	if(!$submit) {
		$ocarina->addValue('news', $ocarina->searchNewsByApprovation());
		$ocarina->addValue('pagine', $ocarina->searchPageByApprovation());
		$ocarina->addValue('commenti', $ocarina->searchCommentByApprovation());
	}
	else
		if($minititolo_news !== '')
			if($ocarina->editNews('approvato', '1', $minititolo_news)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'News '.$minititolo_news.' approved.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 0));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'News '.$minititolo_news.' approvation failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 1));
			}
		elseif($id_commento !== '')
			if($ocarina->editComment('approvato', '1', $id_commento)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Comment #'.$id_commento.' approved.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 2));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Comment #'.$id_commento.' approvation failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 3));
			}
		elseif($minititolo_pagina !== '')
			if($ocarina->editPage('approvato', '1', $minititolo_pagina)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Page '.$minititolo_pagina.' approved.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 4));
			}
			else {
				if($comment->config[0]->log == 1)
					$comment->log($ocarina->username[0]->nickname, 'Page '.$minititolo_pagina.' approvation failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('approve', 5));
			}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('approve', 6));
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('approva.tpl');
