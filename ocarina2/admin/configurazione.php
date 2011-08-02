<?php
/**
	/admin/configurazione.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$nomesito = ((isset($_POST['nomesito'])) && ($_POST['nomesito'] !== '')) ? $ocarina->purge($_POST['nomesito']) : '';
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $ocarina->purge($_POST['email']) : '';
$bbcode = ((isset($_POST['bbcode'])) && (is_numeric($_POST['bbcode'])) && ($_POST['bbcode'] !== '')) ? $ocarina->purge((int)$_POST['bbcode']) : '';
$registrazioni = ((isset($_POST['registrazioni'])) && (is_numeric($_POST['registrazioni'])) && ($_POST['registrazioni'] !== '')) ? $ocarina->purge((int)$_POST['registrazioni']) : '';
$validazioneaccount = ((isset($_POST['validazioneaccount'])) && (is_numeric($_POST['validazioneaccount'])) && ($_POST['validazioneaccount'] !== '')) ? $ocarina->purge((int)$_POST['validazioneaccount']) : '';
$commenti = ((isset($_POST['commenti'])) && (is_numeric($_POST['commenti'])) && ($_POST['commenti'] !== '')) ? $ocarina->purge((int)$_POST['commenti']) : '';
$approvacommenti = ((isset($_POST['approvacommenti'])) && (is_numeric($_POST['approvacommenti'])) && ($_POST['approvacommenti'] !== '')) ? $ocarina->purge((int)$_POST['approvacommenti']) : '';
$log = ((isset($_POST['log'])) && (is_numeric($_POST['log'])) && ($_POST['log'] !== '')) ? $ocarina->purge((int)$_POST['log']) : '';
$cookie = ((isset($_POST['cookie'])) && ($_POST['cookie'] !== '')) ? $ocarina->purge($_POST['cookie']) : '';
$loginexpire = ((isset($_POST['loginexpire'])) && ($_POST['loginexpire'] !== '')) ? $ocarina->purge($_POST['loginexpire']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $ocarina->purge($_POST['skin']) : '';
$description = ((isset($_POST['description'])) && ($_POST['description'] !== '')) ? $ocarina->purge($_POST['description']) : '';
$limitenews = ((isset($_POST['limitenews'])) && (is_numeric($_POST['limitenews'])) && ($_POST['limitenews'] !== '')) ? $ocarina->purge((int)$_POST['limitenews']) : '';
$impaginazionenews = ((isset($_POST['impaginazionenews'])) && (is_numeric($_POST['impaginazionenews'])) && ($_POST['impaginazionenews'] !== '')) ? $ocarina->purge((int)$_POST['impaginazionenews']) : '';
$limiteonline = ((isset($_POST['limiteonline'])) && (is_numeric($_POST['limiteonline'])) && ($_POST['limiteonline'] !== '')) ? $ocarina->purge((int)$_POST['limiteonline']) : '';
$permettivoto = ((isset($_POST['permettivoto'])) && (is_numeric($_POST['permettivoto'])) && ($_POST['permettivoto'] !== '')) ? $ocarina->purge((int)$_POST['permettivoto']) : '';
$url = ((isset($_POST['url'])) && ($_POST['url'] !== '')) ? $ocarina->purge($_POST['url']) : '';
$url_index = ((isset($_POST['url_index'])) && ($_POST['url_index'] !== '')) ? $ocarina->purge($_POST['url_index']) : '';
$url_admin = ((isset($_POST['url_admin'])) && ($_POST['url_admin'] !== '')) ? $ocarina->purge($_POST['url_admin']) : '';
$url_rendering = ((isset($_POST['url_rendering'])) && ($_POST['url_rendering'] !== '')) ? $ocarina->purge($_POST['url_rendering']) : '';
$url_immagini = ((isset($_POST['url_immagini'])) && ($_POST['url_immagini'] !== '')) ? $ocarina->purge($_POST['url_immagini']) : '';
$root = ((isset($_POST['root'])) && ($_POST['root'] !== '')) ? $ocarina->purge($_POST['root']) : '';
$root_index = ((isset($_POST['root_index'])) && ($_POST['root_index'] !== '')) ? $ocarina->purge($_POST['root_index']) : '';
$root_admin = ((isset($_POST['root_admin'])) && ($_POST['root_admin'] !== '')) ? $ocarina->purge($_POST['root_admin']) : '';
$root_rendering = ((isset($_POST['root_rendering'])) && ($_POST['root_rendering'] !== '')) ? $ocarina->purge($_POST['root_rendering']) : '';
$root_immagini = ((isset($_POST['root_immagini'])) && ($_POST['root_immagini'] !== '')) ? $ocarina->purge($_POST['root_immagini']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 15).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 1))
	if(!$submit) {
		$ocarina->addValue('nomesito_default', $ocarina->config[0]->nomesito);
		$ocarina->addValue('email_default', $ocarina->config[0]->email);
		$ocarina->addValue('bbcode_default', $ocarina->config[0]->bbcode);
		$ocarina->addValue('registrazioni_default', $ocarina->config[0]->registrazioni);
		$ocarina->addValue('validazioneaccount_default', $ocarina->config[0]->validazioneaccount);
		$ocarina->addValue('commenti_default', $ocarina->config[0]->commenti);
		$ocarina->addValue('approvacommenti_default', $ocarina->config[0]->approvacommenti);
		$ocarina->addValue('log_default', $ocarina->config[0]->log);
		$ocarina->addValue('cookie_default', $ocarina->config[0]->cookie);
		$ocarina->addValue('loginexpire_default', $ocarina->config[0]->loginexpire);
		$ocarina->addValue('listaskin', $ocarina->getSkinList());
		$ocarina->addValue('skin_default', $ocarina->config[0]->skin);
		$ocarina->addValue('description_default', $ocarina->config[0]->description);
		$ocarina->addValue('limitenews_default', $ocarina->config[0]->limitenews);
		$ocarina->addValue('impaginazionenews_default', $ocarina->config[0]->impaginazionenews);
		$ocarina->addValue('limiteonline_default', $ocarina->config[0]->limiteonline);
		$ocarina->addValue('permettivoto_default', $ocarina->config[0]->permettivoto);
		$ocarina->addValue('url_default', $ocarina->config[0]->url);
		$ocarina->addValue('url_index_default', $ocarina->config[0]->url_index);
		$ocarina->addValue('url_admin_default', $ocarina->config[0]->url_admin);
		$ocarina->addValue('url_rendering_default', $ocarina->config[0]->url_rendering);
		$ocarina->addValue('url_immagini_default', $ocarina->config[0]->url_immagini);
		$ocarina->addValue('root_default', $ocarina->config[0]->root);
		$ocarina->addValue('root_index_default', $ocarina->config[0]->root_index);
		$ocarina->addValue('root_admin_default', $ocarina->config[0]->root_admin);
		$ocarina->addValue('root_rendering_default', $ocarina->config[0]->root_rendering);
		$ocarina->addValue('root_immagini_default', $ocarina->config[0]->root_immagini);
	}
	else
		if(($ocarina->editConfig('nomesito', $nomesito)) && ($ocarina->editConfig('email', $email)) && ($ocarina->editConfig('bbcode', $bbcode)) && ($ocarina->editConfig('registrazioni', $registrazioni)) && ($ocarina->editConfig('validazioneaccount', $validazioneaccount)) && ($ocarina->editConfig('commenti', $commenti)) && ($ocarina->editConfig('approvacommenti', $approvacommenti)) && ($ocarina->editConfig('log', $log)) && ($ocarina->editConfig('cookie', $cookie)) && ($ocarina->editConfig('loginexpire', $loginexpire)) && ($ocarina->editConfig('skin', $skin)) && ($ocarina->editConfig('description', $description)) && ($ocarina->editConfig('limitenews', $limitenews)) && ($ocarina->editConfig('impaginazionenews', $impaginazionenews)) && ($ocarina->editConfig('permettivoto', $permettivoto)) && ($ocarina->editConfig('limiteonline', $limiteonline)) && ($ocarina->editConfig('url', $url)) && ($ocarina->editConfig('url_index', $url_index)) && ($ocarina->editConfig('url_admin', $url_admin)) && ($ocarina->editConfig('url_rendering', $url_rendering)) && ($ocarina->editConfig('url_immagini', $url_immagini)) && ($ocarina->editConfig('root', $root)) && ($ocarina->editConfig('root_index', $root_index)) && ($ocarina->editConfig('root_admin', $root_admin)) && ($ocarina->editConfig('root_rendering', $root_rendering)) && ($ocarina->editConfig('root_immagini', $root_immagini)))
			$ocarina->addValue('result', $ocarina->getLanguage('configuration', 0));
		else
			$ocarina->addValue('result', $ocarina->getLanguage('configuration', 0));
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('configurazione.tpl');
