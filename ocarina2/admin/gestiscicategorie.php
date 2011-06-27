<?php
/**
	/admin/creacategoria.php
	(C) Giovanni Capuano 2011
*/
ob_start('ob_gzhandler');
require_once('../core/class.Category.php');
require_once('../core/class.Rendering.php');

$categoria = new Category();
$rendering = new Rendering();
$config = $categoria->getConfig();
$categoria_news = ((isset($_POST['categoria_news'])) && ($_POST['categoria_news'] !== '')) ? $categoria->purge($_POST['categoria_news']) : '';
$categoria_pagina = ((isset($_POST['categoria_pagina'])) && ($_POST['categoria_pagina'] !== '')) ? $categoria->purge($_POST['categoria_pagina']) : '';
$categoria_news_rimuovi = ((isset($_POST['categoria_news_rimuovi'])) && ($_POST['categoria_news_rimuovi'] !== '')) ? $categoria->purge($_POST['categoria_news_rimuovi']) : '';
$categoria_pagina_rimuovi = ((isset($_POST['categoria_pagina_rimuovi'])) && ($_POST['categoria_pagina_rimuovi'] !== '')) ? $categoria->purge($_POST['categoria_pagina_rimuovi']) : '';
$submit = isset($_POST['submit']) ? true : false;

$logged = $categoria->isLogged() ? true : false;
if($logged)
	$username = $categoria->searchUserByField('secret', $categoria->getCookie());
$rendering->addValue('utente', $logged ? $username[0]->nickname : '');
$rendering->addValue('grado', $logged ? $username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Gestisci categorie &raquo; Amministrazione &raquo; '.$config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);

if($logged) {
	if(!$submit) {
		$rendering->addValue('categorie_news', $categoria->getCategory('news'));
		$rendering->addValue('categorie_pagine', $categoria->getCategory('pagine'));
	}
	elseif($submit) {
		if(($categoria_news !== '') && ($username[0]->grado < 4))
			if($categoria->createCategory('news', $categoria_news))
				$rendering->addValue('result', 'La categoria è stata creata con successo.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della categoria.');
		elseif(($categoria_pagina !== '') && ($username[0]->grado < 4))
			if($categoria->createCategory('pagina', $categoria_pagina))
				$rendering->addValue('result', 'La categoria è stata creata con successo.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la creazione della categoria.');
		elseif(($categoria_news_rimuovi !== '') && ($username[0]->grado < 4))
			if($categoria->deleteCategory('news', $categoria_news_rimuovi))
				$rendering->addValue('result', 'La categoria è stata rimossa con successo.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la rimozione della categoria.');
		elseif(($categoria_pagina_rimuovi !== '') && ($username[0]->grado < 4))
			if($categoria->deleteCategory('pagina', $categoria_pagina_rimuovi))
				$rendering->addValue('result', 'La categoria è stata rimossa con successo.');
			else
				$rendering->addValue('result', 'È accaduto un errore durante la rimozione della categoria.');
		else
			$rendering->addValue('result', 'È accaduto un errore durante la creazione della categoria.');
	}
}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('logged', $logged);
$rendering->addValue('submit', $submit);
(($logged) && ($username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('gestiscicategorie.tpl');
