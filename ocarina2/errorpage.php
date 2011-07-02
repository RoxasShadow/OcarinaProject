<?php
/**
	/errorpage.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->skin = $logged ? $username[0]->skin : $news->config[0]->skin;
$rendering->addValue('titolo', 'Errore '.$id.' &raquo; '.$news->config[0]->nomesito);
$rendering->addValue('keywords', $news->config[0]->keywords);
$rendering->addValue('description', $news->config[0]->description);

if($news->config[0]->log == 1)
	$news->log(($logged) ? $username[0]->nickname : '~', 'Error '.$id);
$rendering->addValue('id', $id);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('errorpage.tpl');
