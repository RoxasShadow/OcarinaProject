<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$id = ((isset($_GET['id'])) && ($_GET['id'] !== '') && (is_numeric($_GET['id']))) ? (int)$_GET['id'] : '';

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 3)) {
	$ocarina->deleteComment($id);
	if($ocarina->config[0]->log == 1)
		$ocarina->log($ocarina->username[0]->nickname, 'Comment '.$id.' deleted.');
}

if(isset($_SERVER['HTTP_REFERER']))
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: '.$config[0]->url_index.'/index.php');
