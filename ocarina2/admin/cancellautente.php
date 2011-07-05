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
$rendering->addValue('titolo', 'Cancella utente &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado == 1))
	if(!$submit)
		$rendering->addValue('utenti', $user->getUser());
	else
		if(!$all)
			if($user->deleteUser($nickname)) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has deleted '.$nickname.'.');
				$rendering->addValue('result', 'L\'utente è stato cancellato.');
			}
			else {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione di '.$nickname.'.');
			}
		else
			if(!$user->deleteUser($nickname)) {
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has failed the deletion of '.$nickname.' and all his contents.');
				$rendering->addValue('result', 'È accaduto un errore più o meno grave durante la cancellazione di '.$nickname.' insieme a tutti i suoi contenuti.');
			}
			else {
				$comment->deleteCommentByUser($nickname);
				$comment->deleteNewsByUser($nickname);
				$page->deletePageByUser($nickname);
				if($user->config[0]->log == 1)
					$user->log($user->username[0]->nickname, 'Has deleted '.$nickname.' and all his contents.');
				$rendering->addValue('result', 'L\'utente è stato cancellato insieme a tutti i suoi contenuti.');
			}	
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('cancellautente.tpl');
