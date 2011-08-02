<?php
/**
	/logout.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
if((isset($_GET['redirect'])) && ($_GET['redirect'] !== ''))
	$redirect = $ocarina->config[0]->url_index.'/'.$ocarina->purge($_GET['redirect']);
elseif((isset($_SERVER['HTTP_REFERER'])) && ($_SERVER['HTTP_REFERER'] !== ''))
	$redirect = $ocarina->purge($_SERVER['HTTP_REFERER']);
else
	$redirect = $ocarina->config[0]->url_index.'/index.php';

if($ocarina->isLogged()) {
	$ocarina->logout();
	header('Refresh: 0; URL='.$redirect);
}
else
	header('Refresh: 0; URL='.$redirect);
