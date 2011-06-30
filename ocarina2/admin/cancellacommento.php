<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('../core/class.Comments.php');

$comments = new Comments();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$logged = $comments->isLogged() ? true : false;
if($logged)
	$username = $comments->searchUserByField('secret', $comments->getCookie());

if(($logged) && ($username[0]->grado < 3))
	$comments->deleteComment($id);

if(isset($_SERVER['HTTP_REFERER']))
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: index.php');
