<?php
/**
	/admin/cancellanews.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();
$minititolo_news = ((isset($_POST['content'])) && ($_POST['content'] !== '')) ? $news->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Cancella news &raquo; Amministrazione &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged)
	if(!$submit)
		$rendering->addValue('content', $news->searchNews(''));
	elseif($submit)
		if(($minititolo_news !== '') && ($username[0]->grado < 3))
			if($news->deleteNews($minititolo_news))
				$rendering->addValue('result', 'La news è stata cancellata.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la cancellazione della news.');
		else
			$rendering->addValue('result', 'Non sei abilitato a cancellare questa news.');
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
$rendering->addValue('whatis', 'news');
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('deletecontent.tpl');
