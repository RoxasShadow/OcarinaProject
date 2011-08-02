<?php
/**
	/admin/creacategoria.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$ocarina_news = ((isset($_POST['categoria_news'])) && (isset($_POST['creaCategoriaNews'])) && ($_POST['categoria_news'] !== '')) ? $ocarina->purge($_POST['categoria_news']) : '';
$ocarina_pagina = ((isset($_POST['categoria_pagina'])) && (isset($_POST['creaCategoriaPagine'])) &&  ($_POST['categoria_pagina'] !== '')) ? $ocarina->purge($_POST['categoria_pagina']) : '';
$ocarina_news_rimuovi = ((isset($_POST['categoria_news_rimuovi'])) && (isset($_POST['rimuoviCategoriaNews'])) &&  ($_POST['categoria_news_rimuovi'] !== '')) ? $ocarina->purge($_POST['categoria_news_rimuovi']) : '';
$ocarina_pagina_rimuovi = ((isset($_POST['categoria_pagina_rimuovi'])) && (isset($_POST['rimuoviCategoriaPagine'])) &&  ($_POST['categoria_pagina_rimuovi'] !== '')) ? $ocarina->purge($_POST['categoria_pagina_rimuovi']) : '';
$submit = ((isset($_POST['creaCategoriaNews'])) || (isset($_POST['creaCategoriaPagine'])) || (isset($_POST['rimuoviCategoriaNews'])) || (isset($_POST['rimuoviCategoriaPagine']))) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 18).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado <= 3))
	if(!$submit) {
		$ocarina->addValue('categorie_news', $ocarina->getCategory('news'));
		$ocarina->addValue('categorie_pagine', $ocarina->getCategory('pagine'));
	}
	else
		if($ocarina_news !== '')
			if($ocarina->createCategory('news', $ocarina_news)) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 0));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news.' created.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 1));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news.' creation failed.');
			}
		elseif($ocarina_pagina !== '')
			if($ocarina->createCategory('pagine', $ocarina_pagina)) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 0));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_pagina.' created.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 1));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_pagina.' creation failed.');
			}
		elseif($ocarina_news_rimuovi !== '') {
			$ocarina = new News();
			$getNews = $ocarina->searchNewsByCategory($ocarina_news_rimuovi);
			foreach($getNews as $v)
				$ocarina->editNews('categoria', 'Senza categoria', $v->minititolo);
			if($ocarina_news_rimuovi) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 8));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news_rimuovi.' deletion failed.');
			}
			elseif($ocarina->deleteCategory('news', $ocarina_news_rimuovi)) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 2));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news_rimuovi.' deleted.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 3));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news_rimuovi.' deletion failed.');
			}
		}
		elseif($ocarina_pagina_rimuovi !== '') {
			$ocarina = new Page();
			$getPage = $ocarina->searchPageByCategory($ocarina_pagina_rimuovi);
			foreach($getPage as $v)
				$ocarina->editPage('categoria', 'Senza categoria', $v->minititolo);
			if($ocarina_pagina_rimuovi) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 8));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_news_rimuovi.' deletion failed.');
			}
			elseif($ocarina->deleteCategory('pagine', $ocarina_pagina_rimuovi)) {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 2));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_pagina_rimuovi.' deletion failed.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('managecategory', 3));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Category '.$ocarina_pagina_rimuovi.' deletion failed.');
			}
		}
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('error', 0));
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Error in category management.');
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('gestiscicategorie.tpl');
