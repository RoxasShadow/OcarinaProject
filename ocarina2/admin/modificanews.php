<?php
/**
	/admin/modificanews.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$config = $news->getConfig();
$titolo_news = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['titolo']))) : '';
$categoria_news = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['categoria']))) : '';
$testo_news = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($news->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['selected']))) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $news->isLogged() ? true : false;
if($logged)
	$username = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Modifica news &raquo; Amministrazione &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged)
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">Scegli la news da modificare <select name="selected">';
		if($username[0]->grado == 3)
			foreach($news->searchNewsByUser($username[0]->nickname) as $v)
				$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		elseif($username[0]->grado < 3)
			foreach($news->getNews() as $v)
				$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		$result .= '</select><input type="submit" name="sel_submit" value="Modifica news">';
		$rendering->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$rendering->addValue('bbcode', $config[0]->bbcode);
		$rendering->addValue('categorie', $news->getCategory('news'));
		if($this_news = $news->getNews($selected)) {
			$rendering->addValue('titolo_default', $this_news[0]->titolo);
			$rendering->addValue('categoria', $this_news[0]->categoria);
			$rendering->addValue('testo', $this_news[0]->contenuto);
		}
		else
			$rendering->addValue('result', 'È accaduto un errore, la news selezionata non esiste.');
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '') && ($username[0]->grado < 4)) {
			$this_news = $news->getNews($selected);
			if(($username[0]->grado == 3) && ($this_news[0]->nickname !== $username[0]->nickname))
				$rendering->addValue('result', 'Non sei abilitato a modificare questa news.');
			elseif((($username[0]->grado == 3) && ($this_news[0]->nickname == $username[0]->nickname)) || ($username[0]->grado < 3)) 
				if(($news->editNews('titolo', $titolo_news, $this_news[0]->minititolo)) && ($news->editNews('categoria', $categoria_news, $this_news[0]->minititolo)) && ($news->editNews('contenuto', $testo_news, $this_news[0]->minititolo)) && ($news->editNews('dataultimamodifica', date('d-m-y'), $this_news[0]->minititolo)) && ($news->editNews('oraultimamodifica', date('G:m:i'), $this_news[0]->minititolo)) && ($news->editNews('autoreultimamodifica', $username[0]->nickname, $this_news[0]->minititolo)))
					$rendering->addValue('result', 'La news è stata modificata.');
		}
		else
			$rendering->addValue('result', 'È accaduto un errore durante la modifica della news. Controlla di non aver lasciato alcun campo vuoto.');
	}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
$rendering->addValue('sel', $selected);
$rendering->addValue('whatis', 'Modifica news');
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
