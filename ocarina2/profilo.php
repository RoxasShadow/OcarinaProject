<?php
/**
	/profilo.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$nickname = ((isset($_GET['nickname'])) && ($_GET['nickname'] !== '')) ? $user->purge($_GET['nickname']) : '';
if($nickname == '')
	$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $user->purge($_POST['nickname']) : '';

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('description', ($nickname !== '') ? $user->getLanguage('description', 6).$nickname.'.' : $user->getLanguage('description', 5));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());

if($nickname == '') {
	$rendering->addValue('titolo', $user->getLanguage('profile', 0).$user->getLanguage('title', 2).$user->config[0]->nomesito);
	$rendering->addValue('listautenti', $user->getUser());
}
else {
	$rendering->addValue('titolo', (($user->isLogged()) && ($nickname == $user->username[0]->nickname)) ? $user->getLanguage('profile', 1) : $user->getLanguage('profile', 2).$nickname.$user->getLanguage('title', 2).$user->config[0]->nomesito);
	$getUser = $user->getUser($nickname);
	$rendering->addValue('result', $getUser ? $getUser : $user->getLanguage('profile', 3));		
}
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('profilo.tpl');
