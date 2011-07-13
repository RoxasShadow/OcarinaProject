<?php
/**
	/admin/modificanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.News.php');
require_once('../core/class.Rendering.php');

$news = new News();
$rendering = new Rendering();
$titolo_news = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['titolo']))) : '';
$categoria_news = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['categoria']))) : '';
$testo_news = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? addslashes($news->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? htmlentities(addslashes($news->purgeByXSS($_POST['selected']))) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $news->isLogged() ? $news->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $news->getLanguage('title', 20).$news->getLanguage('title', 2).$news->getLanguage('title', 10).$news->getLanguage('title', 2).$news->config[0]->nomesito);

if(($news->isLogged()) && ($news->username[0]->grado < 4))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">'.$news->getLanguage('editnews', 0).'<select name="selected">';
		if($news->username[0]->grado == 3) {
			$newsByUser = $news->searchNewsByUser($news->username[0]->nickname);
			if($newsByUser !== false)
				foreach($news->searchNewsByUser($news->username[0]->nickname) as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		elseif($news->username[0]->grado < 3) {
			$allNews = $news->searchNews(''); // È come una wildcard 
			if($allNews !== false)
				foreach($allNews as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		$result .= '</select><input type="submit" name="sel_submit" value="'.$news->getLanguage('title', 20).'">';
		$rendering->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$rendering->addValue('bbcode', $news->config[0]->bbcode);
		$rendering->addValue('categorie', $news->getCategory('news'));
		if($this_news = $news->getNews($selected)) {
			$rendering->addValue('titolo_default', $this_news[0]->titolo);
			$rendering->addValue('categoria', $this_news[0]->categoria);
			$rendering->addValue('testo', $this_news[0]->contenuto);
		}
		else
			$rendering->addValue('result', $news->getLanguage('editnews', 1));
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '') && ($news->username[0]->grado < 4)) {
			$this_news = $news->getNews($selected);
			if(($news->username[0]->grado == 3) && ($this_news[0]->nickname !== $news->username[0]->nickname))
				$rendering->addValue('result', $news->getLanguage('editnews', 2));
			elseif((($news->username[0]->grado == 3) && ($this_news[0]->nickname == $news->username[0]->nickname)) || ($news->username[0]->grado < 3)) 
				if(($news->editNews('titolo', $titolo_news, $this_news[0]->minititolo)) && ($news->editNews('categoria', $categoria_news, $this_news[0]->minititolo)) && ($news->editNews('contenuto', $testo_news, $this_news[0]->minititolo)) && ($news->editNews('dataultimamodifica', date('d-m-y'), $this_news[0]->minititolo)) && ($news->editNews('oraultimamodifica', date('G:m:i'), $this_news[0]->minititolo)) && ($news->editNews('autoreultimamodifica', $news->username[0]->nickname, $this_news[0]->minititolo)))
					$rendering->addValue('result', $news->getLanguage('editnews', 3));
		}
		else
			$rendering->addValue('result', $news->getLanguage('editnews', 4));
	}
else
	$rendering->addValue('result', $news->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
$rendering->addValue('sel', $selected);
(($news->isLogged()) && ($news->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('formcontents.tpl');
