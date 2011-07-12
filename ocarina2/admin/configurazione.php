<?php
/**
	/admin/configurazione.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$nomesito = ((isset($_POST['nomesito'])) && ($_POST['nomesito'] !== '')) ? $user->purge($_POST['nomesito']) : '';
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$bbcode = ((isset($_POST['bbcode'])) && (is_numeric($_POST['bbcode'])) && ($_POST['bbcode'] !== '')) ? $user->purge((int)$_POST['bbcode']) : '';
$registrazioni = ((isset($_POST['registrazioni'])) && (is_numeric($_POST['registrazioni'])) && ($_POST['registrazioni'] !== '')) ? $user->purge((int)$_POST['registrazioni']) : '';
$validazioneaccount = ((isset($_POST['validazioneaccount'])) && (is_numeric($_POST['validazioneaccount'])) && ($_POST['validazioneaccount'] !== '')) ? $user->purge((int)$_POST['validazioneaccount']) : '';
$commenti = ((isset($_POST['commenti'])) && (is_numeric($_POST['commenti'])) && ($_POST['commenti'] !== '')) ? $user->purge((int)$_POST['commenti']) : '';
$approvacommenti = ((isset($_POST['approvacommenti'])) && (is_numeric($_POST['approvacommenti'])) && ($_POST['approvacommenti'] !== '')) ? $user->purge((int)$_POST['approvacommenti']) : '';
$log = ((isset($_POST['log'])) && (is_numeric($_POST['log'])) && ($_POST['log'] !== '')) ? $user->purge((int)$_POST['log']) : '';
$cookie = ((isset($_POST['cookie'])) && ($_POST['cookie'] !== '')) ? $user->purge($_POST['cookie']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $user->purge($_POST['skin']) : '';
$description = ((isset($_POST['description'])) && ($_POST['description'] !== '')) ? $user->purge($_POST['description']) : '';
$limitenews = ((isset($_POST['limitenews'])) && (is_numeric($_POST['limitenews'])) && ($_POST['limitenews'] !== '')) ? $user->purge((int)$_POST['limitenews']) : '';
$impaginazionenews = ((isset($_POST['impaginazionenews'])) && (is_numeric($_POST['impaginazionenews'])) && ($_POST['impaginazionenews'] !== '')) ? $user->purge((int)$_POST['impaginazionenews']) : '';
$limiteonline = ((isset($_POST['limiteonline'])) && (is_numeric($_POST['limiteonline'])) && ($_POST['limiteonline'] !== '')) ? $user->purge((int)$_POST['limiteonline']) : '';
$permettivoto = ((isset($_POST['permettivoto'])) && (is_numeric($_POST['permettivoto'])) && ($_POST['permettivoto'] !== '')) ? $user->purge((int)$_POST['permettivoto']) : '';
$url = ((isset($_POST['url'])) && ($_POST['url'] !== '')) ? $user->purge($_POST['url']) : '';
$url_index = ((isset($_POST['url_index'])) && ($_POST['url_index'] !== '')) ? $user->purge($_POST['url_index']) : '';
$url_admin = ((isset($_POST['url_admin'])) && ($_POST['url_admin'] !== '')) ? $user->purge($_POST['url_admin']) : '';
$url_rendering = ((isset($_POST['url_rendering'])) && ($_POST['url_rendering'] !== '')) ? $user->purge($_POST['url_rendering']) : '';
$url_immagini = ((isset($_POST['url_immagini'])) && ($_POST['url_immagini'] !== '')) ? $user->purge($_POST['url_immagini']) : '';
$root = ((isset($_POST['root'])) && ($_POST['root'] !== '')) ? $user->purge($_POST['root']) : '';
$root_index = ((isset($_POST['root_index'])) && ($_POST['root_index'] !== '')) ? $user->purge($_POST['root_index']) : '';
$root_admin = ((isset($_POST['root_admin'])) && ($_POST['root_admin'] !== '')) ? $user->purge($_POST['root_admin']) : '';
$root_rendering = ((isset($_POST['root_rendering'])) && ($_POST['root_rendering'] !== '')) ? $user->purge($_POST['root_rendering']) : '';
$root_immagini = ((isset($_POST['root_immagini'])) && ($_POST['root_immagini'] !== '')) ? $user->purge($_POST['root_immagini']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', 'Configurazione &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);

if(($user->isLogged()) && ($user->username[0]->grado == 1))
	if(!$submit) {
		$rendering->addValue('nomesito_default', $user->config[0]->nomesito);
		$rendering->addValue('email_default', $user->config[0]->email);
		$rendering->addValue('bbcode_default', $user->config[0]->bbcode);
		$rendering->addValue('registrazioni_default', $user->config[0]->registrazioni);
		$rendering->addValue('validazioneaccount_default', $user->config[0]->validazioneaccount);
		$rendering->addValue('commenti_default', $user->config[0]->commenti);
		$rendering->addValue('approvacommenti_default', $user->config[0]->approvacommenti);
		$rendering->addValue('log_default', $user->config[0]->log);
		$rendering->addValue('cookie_default', $user->config[0]->cookie);
		$rendering->addValue('listaskin', $rendering->getSkinList());
		$rendering->addValue('skin_default', $user->config[0]->skin);
		$rendering->addValue('description_default', $user->config[0]->description);
		$rendering->addValue('limitenews_default', $user->config[0]->limitenews);
		$rendering->addValue('impaginazionenews_default', $user->config[0]->impaginazionenews);
		$rendering->addValue('limiteonline_default', $user->config[0]->limiteonline);
		$rendering->addValue('permettivoto_default', $user->config[0]->permettivoto);
		$rendering->addValue('url_default', $user->config[0]->url);
		$rendering->addValue('url_index_default', $user->config[0]->url_index);
		$rendering->addValue('url_admin_default', $user->config[0]->url_admin);
		$rendering->addValue('url_rendering_default', $user->config[0]->url_rendering);
		$rendering->addValue('url_immagini_default', $user->config[0]->url_immagini);
		$rendering->addValue('root_default', $user->config[0]->root);
		$rendering->addValue('root_index_default', $user->config[0]->root_index);
		$rendering->addValue('root_admin_default', $user->config[0]->root_admin);
		$rendering->addValue('root_rendering_default', $user->config[0]->root_rendering);
		$rendering->addValue('root_immagini_default', $user->config[0]->root_immagini);
	}
	else
		if(($user->editConfig('nomesito', $nomesito)) && ($user->editConfig('email', $email)) && ($user->editConfig('bbcode', $bbcode)) && ($user->editConfig('registrazioni', $registrazioni)) && ($user->editConfig('validazioneaccount', $validazioneaccount)) && ($user->editConfig('commenti', $commenti)) && ($user->editConfig('approvacommenti', $approvacommenti)) && ($user->editConfig('log', $log)) && ($user->editConfig('cookie', $cookie)) && ($user->editConfig('skin', $skin)) && ($user->editConfig('description', $description)) && ($user->editConfig('limitenews', $limitenews)) && ($user->editConfig('impaginazionenews', $impaginazionenews)) && ($user->editConfig('permettivoto', $permettivoto)) && ($user->editConfig('limiteonline', $limiteonline)) && ($user->editConfig('url', $url)) && ($user->editConfig('url_index', $url_index)) && ($user->editConfig('url_admin', $url_admin)) && ($user->editConfig('url_rendering', $url_rendering)) && ($user->editConfig('url_immagini', $url_immagini)) && ($user->editConfig('root', $root)) && ($user->editConfig('root_index', $root_index)) && ($user->editConfig('root_admin', $root_admin)) && ($user->editConfig('root_rendering', $root_rendering)) && ($user->editConfig('root_immagini', $root_immagini)))
			$rendering->addValue('result', 'Le modifica alla configurazione sono state apportate con successo.');
		else
			$rendering->addValue('result', 'È accaduto un errore durante la modifica alla configurazione.');
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('configurazione.tpl');
