<?php
/**
	/admin/newsletter.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$testo_email = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? $_POST['testo'] : '';
$oggetto_email = ((isset($_POST['oggetto'])) && ($_POST['oggetto'] !== '')) ? $_POST['oggetto'] : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 30).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado <= 2))
	if($submit)
		if(($testo_email !== '') && ($oggetto_email !== '')) {
			$users = $user->getUser();
			$notsend = 0;
			foreach($users as $v)
				if(!$user->sendMail($v->email, $oggetto_email, $testo_email))
					++$notsend;
			if($notsend == 0)
				$rendering->addValue('result', $user->getLanguage('newsletter', 0));
			else
				$rendering->addValue('result', $notsend.$user->getLanguage('newsletter', 1));
		}
		else
			$rendering->addValue('result', $user->getLanguage('newsletter', 2));
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('newsletter.tpl');
