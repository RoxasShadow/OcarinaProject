<?php
/**
	/admin/cancellautente.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$nickname = ((isset($_POST['nickname'])) && (trim($_POST['nickname']) !== '')) ? $ocarina->purgeByXSS($_POST['nickname']) : '';
$all = isset($_POST['all']) ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 14).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1))
	if(!$submit)
		$ocarina->addValue('utenti', $ocarina->getUser());
	else
		if(!$all)
			if($ocarina->deleteUser($nickname)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Has deleted '.$nickname.'.');
				$ocarina->addValue('result', $ocarina->getLanguage('deleteuser', 0));
			}
			else {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$ocarina->addValue('result', str_replace('{$nickname}', $nickname, $ocarina->getLanguage('deleteuser', 1)));
			}
		else
			if(!$ocarina->deleteUser($nickname)) {
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$ocarina->addValue('result', str_replace('{$nickname}', $nickname, $ocarina->getLanguage('deleteuser', 2)));
			}
			else {
				$comment->deleteCommentByUser($nickname);
				$comment->deleteNewsByUser($nickname);
				$ocarina->deletePageByUser($nickname);
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Has deleted '.$nickname.' and all his contents.');
				$ocarina->addValue('result', $ocarina->getLanguage('deleteuser', 3));
			}	
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('cancellautente.tpl');
