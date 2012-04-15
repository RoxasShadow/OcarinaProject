<?php
/**
	/inviamp.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');
require_once('etc/class.ReCaptcha.php');

$ocarina = new Ocarina();
$captcha = new ReCaptcha();
$destinatario = ((isset($_POST['destinatario'])) && ($_POST['destinatario'] !== '')) ? $ocarina->purge($_POST['destinatario']) : '';
$oggetto = ((isset($_POST['oggetto'])) && ($_POST['oggetto'] !== '')) ? $ocarina->purge($_POST['oggetto']) : '';
$contenuto = ((isset($_POST['contenuto'])) && ($_POST['contenuto'] !== '')) ? $ocarina->purge($_POST['contenuto']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 33).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(!$ocarina->isLogged())
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
elseif(!$submit) {
	$ocarina->addValue('listautenti', $ocarina->getUser());
	$ocarina->addValue('captcha', $captcha->getCaptcha());
}
elseif($submit) {
	$captcha->checkCaptcha();
	if($captcha->getError() !== false)
		$ocarina->addValue('result', $ocarina->getLanguage('registration', 12));
	elseif(($destinatario !== '') && ($oggetto !== '') && ($contenuto !== ''))
		if(($ocarina->isUser($destinatario)) && ($ocarina->createPM(array($ocarina->username[0]->nickname, $destinatario, date('d-m-y'), date('G:m:i'), $oggetto, $contenuto, 0)))) {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'PM sent to '.$destinatario.'.');
			$ocarina->addValue('result', $ocarina->getLanguage('sendpm', 0));
		}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'failed the send of PM to '.$destinatario.'.');
			$ocarina->addValue('result', $ocarina->getLanguage('sendpm', 1));
		}
	else {
		if($ocarina->config[0]->log == 1)
			$ocarina->log($ocarina->username[0]->nickname, 'failed the PM send to '.$destinatario.'.');
		$ocarina->addValue('result', $ocarina->getLanguage('sendpm', 2));
	}
}
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('inviamp.tpl');
