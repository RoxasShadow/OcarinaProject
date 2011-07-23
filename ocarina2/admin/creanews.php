<?php
/**
	/admin/creanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$titolo_news = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? $news->purgeSlashes($news->purgeByXSS($_POST['titolo'])) : '';
$categoria_news = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? $news->purge($_POST['categoria']) : '';
$testo_news = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? $news->purgeSlashes($news->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $news->isLogged() ? $news->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $news->getLanguage('title', 16).$news->getLanguage('title', 2).$news->getLanguage('title', 10).$news->getLanguage('title', 2).$news->config[0]->nomesito);

if(($news->isLogged()) && ($news->username[0]->grado <= 3))
	if(!$submit) {
		$rendering->addValue('bbcode', $news->config[0]->bbcode);
		$rendering->addValue('categorie', $news->getCategory('news'));
	}
	else {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '')) {
			if($news->username[0]->grado == 3)
				$approva_news = 0; // non approvato
			else
				$approva_news = 1; // approvato
			$array = array($news->username[0]->nickname, $titolo_news, $news->permalink($titolo_news), $testo_news, $categoria_news, date('d-m-y'), date('G:m:i'), $approva_news);
			if($news->isNews($news->permalink($titolo_news)))
				$rendering->addValue('result', $news->getLanguage('createnews', 0));
			elseif($news->createNews($array)) {
				if($approva_news == 0)
					$rendering->addValue('result', $news->getLanguage('createnews', 1));
				elseif($approva_news == 1)
					$rendering->addValue('result', $news->getLanguage('createnews', 2));
			}
			else
				$rendering->addValue('result', $news->getLanguage('createnews', 3));
		}
		else
			$rendering->addValue('result', $news->getLanguage('createnews', 4));
	}
else
	$rendering->addValue('result', $news->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
