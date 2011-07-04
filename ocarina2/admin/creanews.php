<?php
/**
	/admin/creanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$titolo_news = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['titolo']))) : '';
$categoria_news = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['categoria']))) : '';
$testo_news = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($news->purgeByXSS($_POST['testo'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Crea news &raquo; Amministrazione &raquo; '.$news->config[0]->nomesito);

if($logged)
	if(!$submit) {
		$rendering->addValue('bbcode', $news->config[0]->bbcode);
		$rendering->addValue('categorie', $news->getCategory('news'));
	}
	else {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '') && ($username[0]->grado < 4)) {
			if($username[0]->grado == 3)
				$approva_news = 0; // non approvato
			elseif($username[0]->grado < 3)
				$approva_news = 1; // approvato
			$array = array($username[0]->nickname, $titolo_news, $news->permalink($titolo_news), $testo_news, $categoria_news, date('d-m-y'), date('G:m:i'), $approva_news);
			if($news->isNews($news->permalink($titolo_news)))
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della news. Esiste già una news con lo stesso titolo, prova a sceglierne un altro.');
			elseif($news->createNews($array)) {
				if($news->config[0]->sitemap == 1)
					$news->sitemapNews();
				if($approva_news == 0)
					$rendering->addValue('result', 'La news è stata creata con successo ed è in attesa di approvazione.');
				elseif($approva_news == 1)
					$rendering->addValue('result', 'La news è stata creata con successo.');
			}
			else
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della news.');
		}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la creazione della news. Controlla di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
