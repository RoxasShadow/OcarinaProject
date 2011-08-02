<?php
/**
	/vote.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$action = ((isset($_GET['action'])) && ($_GET['action'] !== '')) ? $ocarina->purge($_GET['action']) : '';
$titolo = ((isset($_GET['titolo'])) && ($_GET['titolo'] !== '')) ? $ocarina->purge($_GET['titolo']) : '';

if($ocarina->isLogged())
	if($action == 'page')
		$ocarina->votePage($titolo);
	elseif($action == 'news')
		$ocarina->voteNews($titolo);

if(isset($_SERVER['HTTP_REFERER']))
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: '.$config[0]->url_index.'/index.php');
