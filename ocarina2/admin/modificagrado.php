<?php
/**
	/admin/modificagrado.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $rendering->purgeByXSS($_POST['nickname']) : '';
$grado = ((isset($_POST['grado'])) && ($_POST['grado'] !== '') && (is_numeric($_POST['grado']))) ? (int)$_POST['grado'] : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 20).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado == 1))
	if(!$submit)
		$rendering->addValue('utenti', $user->getUser());
	else
		if($user->editUser('grado', $grado, $nickname)) {
			if($user->config[0]->log == 1)
				$user->log($user->username[0]->nickname, $nickname.' now is in the grade '.$grado.'.');
			$rendering->addValue('result', $user->getLanguage('editgrade', 0));
		}
		else {
			if($user->config[0]->log == 1)
				$user->log($user->username[0]->nickname, $nickname->username[0]->nickname.' has failed to change the grade of '.$nickname.' in '.$grado.'.');
			$rendering->addValue('result', str_replace('{$$nickname}', $nickname, $user->getLanguage('editgrade', 1$user->getLanguage('editgrade', 0)));
		}
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificagrado.tpl');
