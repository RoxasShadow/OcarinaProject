<?php
/**
	/admin/newsletter.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$testo_email = ((isset($_POST['testo'])) && (trim($_POST['testo']) !== '')) ? $_POST['testo'] : '';
$oggetto_email = ((isset($_POST['oggetto'])) && (trim($_POST['oggetto']) !== '')) ? $_POST['oggetto'] : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 30).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1))
	if($submit)
		if(($testo_email !== '') && ($oggetto_email !== '')) {
			$ocarinas = $ocarina->getUser();
			$notsended = 0;
			$sended = 0;
			foreach($ocarinas as $v)
				if(!$ocarina->sendMail($v->email, $oggetto_email, $testo_email))
					++$notsended;
				else
					++$sended;
			if($notsended == 0)
				$ocarina->addValue('result', str_replace('{$sended}', $sended, $ocarina->getLanguage('newsletter', 0)));
			else
				$ocarina->addValue('result', str_replace('{$notsended}', $notsended, str_replace('{$sended}', $sended, $ocarina->getLanguage('newsletter', 1))));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('newsletter', 2));
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('newsletter.tpl');
