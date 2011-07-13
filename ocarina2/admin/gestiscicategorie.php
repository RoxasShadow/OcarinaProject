<?php
/**
	/admin/creacategoria.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Category.php');
require_once('../core/class.Rendering.php');

$categoria = new Category();
$rendering = new Rendering();
$categoria_news = ((isset($_POST['categoria_news'])) && (isset($_POST['creaCategoriaNews'])) && ($_POST['categoria_news'] !== '')) ? $categoria->purge($_POST['categoria_news']) : '';
$categoria_pagina = ((isset($_POST['categoria_pagina'])) && (isset($_POST['creaCategoriaPagine'])) &&  ($_POST['categoria_pagina'] !== '')) ? $categoria->purge($_POST['categoria_pagina']) : '';
$categoria_news_rimuovi = ((isset($_POST['categoria_news_rimuovi'])) && (isset($_POST['rimuoviCategoriaNews'])) &&  ($_POST['categoria_news_rimuovi'] !== '')) ? $categoria->purge($_POST['categoria_news_rimuovi']) : '';
$categoria_pagina_rimuovi = ((isset($_POST['categoria_pagina_rimuovi'])) && (isset($_POST['rimuoviCategoriaPagine'])) &&  ($_POST['categoria_pagina_rimuovi'] !== '')) ? $categoria->purge($_POST['categoria_pagina_rimuovi']) : '';
$submit = ((isset($_POST['creaCategoriaNews'])) || (isset($_POST['creaCategoriaPagine'])) || (isset($_POST['rimuoviCategoriaNews'])) || (isset($_POST['rimuoviCategoriaPagine']))) ? true : false;

$rendering->addValue('grado', $categoria->isLogged() ? $categoria->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $categoria->getLanguage('title', 17).$categoria->getLanguage('title', 2).$categoria->getLanguage('title', 10).$categoria->getLanguage('title', 2).$categoria->config[0]->nomesito);

if(($categoria->isLogged()) && ($categoria->username[0]->grado <= 3))
	if(!$submit) {
		$rendering->addValue('categorie_news', $categoria->getCategory('news'));
		$rendering->addValue('categorie_pagine', $categoria->getCategory('pagine'));
	}
	else
		if($categoria_news !== '')
			if($categoria->createCategory('news', $categoria_news)) {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 0));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_news.' created.');
			}
			else {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 1));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_news.' creation failed.');
			}
		elseif($categoria_pagina !== '')
			if($categoria->createCategory('pagine', $categoria_pagina)) {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 2));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_pagina.' created.');
			}
			else {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 3));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_pagina.' creation failed.');
			}
		elseif($categoria_news_rimuovi !== '')
			if($categoria->deleteCategory('news', $categoria_news_rimuovi)) {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 4));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_news_rimuovi.' deleted.');
			}
			else {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 5));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_news_rimuovi.' deletion failed.');
			}
		elseif($categoria_pagina_rimuovi !== '')
			if($categoria->deleteCategory('pagine', $categoria_pagina_rimuovi)) {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 6));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_pagina_rimuovi.' deletion failed.');
			}
			else {
				$rendering->addValue('result', $categoria->getLanguage('managecategory', 7));
				if($categoria->config[0]->log == 1)
					$categoria->log($categoria->username[0]->nickname, 'Category '.$categoria_pagina_rimuovi.' deletion failed.');
			}
		else {
			$rendering->addValue('result', $categoria->getLanguage('error', 0));
			if($categoria->config[0]->log == 1)
				$categoria->log($categoria->username[0]->nickname, 'Error in category management.');
		}
else
	$rendering->addValue('result', $categoria->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($categoria->isLogged()) && ($categoria->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('gestiscicategorie.tpl');
