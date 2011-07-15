<?php
/**
	/admin/cancellautente.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Page.php');
require_once('../core/class.Comments.php');
require_once('../core/class.Rendering.php');

$user = new User();
$page = new Page();
$comment = new Comments();
$rendering = new Rendering();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $rendering->purgeByXSS($_POST['nickname']) : '';
$all = isset($_POST['all']) ? true : false;
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 14).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado == 1))
	if(!$submit)
		$rendering->addValue('utenti', $user->getUser());
	else
		if(!$all)
			if($user->deleteUser($nickname)) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has deleted '.$nickname.'.');
				$rendering->addValue('result', $user->getLanguage('deleteuser', 0));
			}
			else {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$rendering->addValue('result', str_replace('{$nickname}', $nickname, $user->getLanguage('deleteuser', 1)));
			}
		else
			if(!$user->deleteUser($nickname)) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$rendering->addValue('result', str_replace('{$nickname}', $nickname, $user->getLanguage('deleteuser', 2)));
			}
			else {
				$comment->deleteCommentByUser($nickname);
				$comment->deleteNewsByUser($nickname);
				$page->deletePageByUser($nickname);
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has deleted '.$nickname.' and all his contents.');
				$rendering->addValue('result', $user->getLanguage('deleteuser', 3));
			}	
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('cancellautente.tpl');
