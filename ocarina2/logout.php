<?php
/**
	/logout.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$logged = $user->isLogged() ? true : false;

if($logged) {
	$user->logout();
	header('Refresh: 0; URL=Aindex.php');
}
else
	header('Refresh: 0; URL=Aindex.php');
