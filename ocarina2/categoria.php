<?php
/**
	/categoria.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.News.php');
require_once('core/class.Page.php');
require_once('core/class.Rendering.php');

$news = new News();
$pagine = new Page();
$rendering = new Rendering();
$config = $news->getConfig();
$secret = $news->getCookie();
$categoria = isset($_GET['cat']) ? $news->purge($_GET['cat']) : '';

$user = $news->searchUserByField('secret', $news->getCookie());
$rendering->addValue('utente', $user[0]->nickname);
$rendering->addValue('titolo', $categoria !== '' ? 'Categoria: '.$categoria.' &raquo; '.$config[0]->nomesito : $config[0]->nomesito);
$rendering->addValue('keywords', $config[0]->keywords);
$rendering->addValue('description', $config[0]->description);
$rendering->addValue('url_rendering', $config[0]->url_rendering);
$rendering->addValue('root_rendering', $config[0]->root_rendering);
$rendering->addValue('skin', $config[0]->skin);

if($categoria == '')
	$rendering->addValue('error', 'Non è stata selezionata nessuna categoria.');
else {
	!$news->isCategory('news', $categoria) ? $rendering->addValue('news', 'Nessuna news è associata alla categoria `'.$categoria.'`.') : $rendering->addValue('news', $news->searchNewsByCategory($categoria));
	!$pagine->isCategory('pagine', $categoria) ? $rendering->addValue('pagine', 'Nessuna pagina è associata alla categoria `'.$categoria.'`.') : $rendering->addValue('pagine', $pagine->searchPageByCategory($categoria));
}
$rendering->renderize('categoria.tpl');
