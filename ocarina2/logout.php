<?php
/**
	/logout.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$redirect = ((isset($_GET['redirect'])) && ($_GET['redirect'] !== '')) ? $user->config[0]->url_index.'/'.$user->purge($_GET['redirect']) : $user->purge($_SERVER['HTTP_REFERER']);

if($user->isLogged()) {
	$user->logout();
	header('Refresh: 0; URL='.$redirect);
}
else
	header('Refresh: 0; URL='.$redirect);
