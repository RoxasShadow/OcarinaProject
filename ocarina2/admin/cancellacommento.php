<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Comments.php');

$comments = new Comments();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$logged = $comments->isLogged() ? true : false;
if($logged)
	$username = $comments->searchUserByField('secret', $comments->getCookie());

if(($logged) && ($username[0]->grado < 3)) {
	$comments->deleteComment($id);
	if($comments->config[0]->log == 1)
		$comments->log($username[0]->nickname, 'Comment '.$id.' deleted.');
}

if(isset($_SERVER['HTTP_REFERER']))
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: '.$config[0]->url_index.'/Aindex.php');