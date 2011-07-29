<?php
/**
	/inviamp.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.PersonalMessage.php');
require_once('core/class.Rendering.php');
require_once('etc/class.ReCaptcha.php');

$pm = new PersonalMessage();
$rendering = new Rendering();
$captcha = new ReCaptcha();
$destinatario = ((isset($_POST['destinatario'])) && ($_POST['destinatario'] !== '')) ? $pm->purge($_POST['destinatario']) : '';
$oggetto = ((isset($_POST['oggetto'])) && ($_POST['oggetto'] !== '')) ? $pm->purge($_POST['oggetto']) : '';
$contenuto = ((isset($_POST['contenuto'])) && ($_POST['contenuto'] !== '')) ? $pm->purge($_POST['contenuto']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $pm->isLogged() ? $pm->username[0]->nickname : '');
$rendering->skin = $pm->isLogged() ? $pm->username[0]->skin : $pm->config[0]->skin;
$rendering->addValue('titolo', $pm->getLanguage('title', 33).$pm->getLanguage('title', 2).$pm->config[0]->nomesito);
$rendering->addValue('useronline', $pm->getUserOnline());
$rendering->addValue('visitatoronline', $pm->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $pm->getTotalVisits());
$rendering->addValue('numeromp', $pm->countPM());

if(!$pm->isLogged())
	$rendering->addValue('result', $pm->getLanguage('error', 4));
elseif(!$submit) {
	$rendering->addValue('listautenti', $pm->getUser());
	$rendering->addValue('captcha', $captcha->getCaptcha());
}
elseif($submit) {
	$captcha->checkCaptcha();
	if($captcha->getError() !== false)
		$rendering->addValue('result', $pm->getLanguage('registration', 12));
	elseif(($destinatario !== '') && ($oggetto !== '') && ($contenuto !== ''))
		if(($pm->isUser($destinatario)) && ($pm->createPM(array($pm->username[0]->nickname, $destinatario, date('d-m-y'), date('G:m:i'), $oggetto, $contenuto, 0)))) {
			if($pm->config[0]->log == 1)
				$pm->log($pm->username[0]->nickname, 'PM sended to '.$destinatario.'.');
			$rendering->addValue('result', $pm->getLanguage('sendpm', 0));
		}
		else {
			if($pm->config[0]->log == 1)
				$pm->log($pm->username[0]->nickname, 'failed the send of PM to '.$destinatario.'.');
			$rendering->addValue('result', $pm->getLanguage('sendpm', 1));
		}
	else {
		if($pm->config[0]->log == 1)
			$pm->log($pm->username[0]->nickname, 'failed the PM send to '.$destinatario.'.');
		$rendering->addValue('result', $pm->getLanguage('sendpm', 2));
	}
}
$rendering->addValue('logged', $pm->isLogged());
$rendering->addValue('submit', $submit);
(($pm->isLogged()) && ($pm->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('inviamp.tpl');
