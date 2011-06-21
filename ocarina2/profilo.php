<?php
/**
	/profilo.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');
require_once('etc/function.BBCode.php');

$user = new User();
$rendering = new Rendering();
$config = $user->getConfig();
$nickname = ((isset($_GET['nickname'])) && ($_GET['nickname'] !== '')) ? $user->purge($_GET['nickname']) : '';
if($nickname == '')
	$nickname = ((isset($_POST['nickname'])) && ($_POST['nickname'] !== '')) ? $user->purge($_POST['nickname']) : '';

$logged = $user->isLogged() ? true : false;
if($logged)
	$username = $user->searchUserByField('secret', $user->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($nickname == '') {
	$rendering->addValue('titolo', 'Profili utenti &raquo; '.$config[0]->nomesito);
	$rendering->addValue('listautenti', $user->getUser());
}
else {
	$rendering->addValue('titolo', $nickname == $username[0]->nickname ? 'Il tuo profilo' : 'Profilo di '.$nickname.' &raquo; '.$config[0]->nomesito);
	if($user->isUser($nickname))
		$rendering->addValue('result', $user->getUser($nickname));
	else
		$rendering->addValue('result', 'L\'utente da te cercato non è attualmente registrato.');
		
}
$rendering->renderize('profilo.tpl');
