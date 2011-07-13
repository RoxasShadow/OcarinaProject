<?php
/**
	/admin/robots.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$robots = ((isset($_POST['robots'])) && ($_POST['robots'] !== '')) ? $rendering->purgeByXSS($_POST['robots']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('grado', $user->isLogged() ? $user->username[0]->grado : '');
$rendering->skin = 'admin';
$rendering->addValue('titolo', $user->getLanguage('title', 22).$user->getLanguage('title', 2).$user->getLanguage('title', 10).$user->getLanguage('title', 2).$user->config[0]->nomesito);

if(($user->isLogged()) && (($user->username[0]->grado < 3) || ($user->username[0]->grado == 5))) {
	if(!$submit) {
		$robots = '';
		if(file_exists($user->config[0]->root_index.'/robots.txt')) {
			$f = fopen($user->config[0]->root_index.'/robots.txt', 'r');
			$robots .= fread($f, filesize($user->config[0]->root_index.'/robots.txt'));
			fclose($f);
			$rendering->addValue('robots', str_replace('{$date}', date('d-m-y'), $user->getLanguage('robots', 0)).'
User-agent: *
Disallow: 
Sitemap: '.$user->config[0]->url_index.'/sitemap.php');
		}
		else
			$rendering->addValue('robots', str_replace('{$date}', date('d-m-y'), $user->getLanguage('robots', 0)).'
'.$robots);
	}
	else {
		$f = fopen($user->config[0]->root_index.'/robots.txt', 'w');
		fwrite($f, $robots);
		fclose($f);
	}
}
else
	$rendering->addValue('result', $user->getLanguage('error', 4));
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('robots.tpl');
