<?php
/**
	/mp.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.PersonalMessage.php');
require_once('core/class.Rendering.php');

$pm = new PersonalMessage();
$rendering = new Rendering();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$rendering->addValue('utente', $pm->isLogged() ? $pm->username[0]->nickname : '');
$rendering->skin = $pm->isLogged() ? $pm->username[0]->skin : $pm->config[0]->skin;
$rendering->addValue('titolo', $pm->getLanguage('title', 33).$pm->getLanguage('title', 2).$pm->config[0]->nomesito);
$rendering->addValue('useronline', $pm->getUserOnline());
$rendering->addValue('visitatoronline', $pm->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $pm->getTotalVisits());
$rendering->addValue('numeromp', $pm->countPM());

if(!$pm->isLogged())
	$rendering->addValue('result', $pm->getLanguage('error', 4));
elseif($id == '')
	$rendering->addValue('result', $pm->getPM('', $pm->username[0]->nickname));
else {
	$yourPM = $pm->getPM($id);
	if($yourPM[0]->destinatario == $pm->username[0]->nickname) {
		$rendering->addValue('result', $yourPM);
		$pm->readedPM($id);
	}
}
$rendering->addValue('logged', $pm->isLogged());
$rendering->addValue('id', $id);
(($pm->isLogged()) && ($pm->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('mp.tpl');
