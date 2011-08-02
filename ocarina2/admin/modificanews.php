<?php
/**
	/admin/modificanews.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$titolo_news = ((isset($_POST['titolo'])) && ($_POST['titolo'] !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['titolo'])) : '';
$categoria_news = ((isset($_POST['categoria'])) && ($_POST['categoria'] !== '')) ? $ocarina->purge($_POST['categoria']) : '';
$testo_news = ((isset($_POST['testo'])) && ($_POST['testo'] !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['testo'])) : '';
$selected = ((isset($_POST['selected'])) && ($_POST['selected'] !== '')) ? $ocarina->purgeSlashes($ocarina->purgeByXSS($_POST['selected'])) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 22).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 4))
	if((!$submit) && ($selected == '')) {
		$result = '<form action="" method="post">'.$ocarina->getLanguage('editnews', 0).'<select name="selected">';
		if($ocarina->username[0]->grado == 3) {
			$ocarinaByUser = $ocarina->searchNewsByUser($ocarina->username[0]->nickname);
			if($ocarinaByUser !== false)
				foreach($ocarina->searchNewsByUser($ocarina->username[0]->nickname) as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		elseif($ocarina->username[0]->grado < 3) {
			$allNews = $ocarina->searchNews(''); // È come una wildcard 
			if($allNews !== false)
				foreach($allNews as $v)
					$result .= '<option value="'.$v->minititolo.'">'.$v->titolo.'</option>';
		}
		$result .= '</select><input type="submit" name="sel_submit" value="'.$ocarina->getLanguage('title', 22).'">';
		$ocarina->addValue('result', $result);
	}	
	elseif((!$submit) && ($selected !== '')) {
		$ocarina->addValue('bbcode', $ocarina->config[0]->bbcode);
		$ocarina->addValue('categorie', $ocarina->getCategory('news'));
		if($this_news = $ocarina->getNews($selected)) {
			$ocarina->addValue('titolo_default', $this_news[0]->titolo);
			$ocarina->addValue('categoria', $this_news[0]->categoria);
			$ocarina->addValue('testo', $this_news[0]->contenuto);
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editnews', 1));
	}
	elseif(($submit) && ($selected !== '')) {
		if(($titolo_news !== '') && ($categoria_news !== '') && ($testo_news !== '') && ($ocarina->username[0]->grado < 4)) {
			$this_news = $ocarina->getNews($selected);
			if(($ocarina->username[0]->grado == 3) && ($this_news[0]->nickname !== $ocarina->username[0]->nickname))
				$ocarina->addValue('result', $ocarina->getLanguage('editnews', 2));
			elseif((($ocarina->username[0]->grado == 3) && ($this_news[0]->nickname == $ocarina->username[0]->nickname)) || ($ocarina->username[0]->grado < 3)) 
				if(($ocarina->editNews('titolo', $titolo_news, $this_news[0]->minititolo)) && ($ocarina->editNews('categoria', $categoria_news, $this_news[0]->minititolo)) && ($ocarina->editNews('contenuto', $testo_news, $this_news[0]->minititolo)) && ($ocarina->editNews('dataultimamodifica', date('d-m-y'), $this_news[0]->minititolo)) && ($ocarina->editNews('oraultimamodifica', date('G:m:i'), $this_news[0]->minititolo)) && ($ocarina->editNews('autoreultimamodifica', $ocarina->username[0]->nickname, $this_news[0]->minititolo)))
					$ocarina->addValue('result', $ocarina->getLanguage('editnews', 3));
		}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editnews', 4));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('sel', $selected);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('formcontents.tpl');
