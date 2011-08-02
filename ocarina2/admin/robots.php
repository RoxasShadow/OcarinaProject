<?php
/**
	/admin/robots.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$robots = ((isset($_POST['robots'])) && ($_POST['robots'] !== '')) ? $ocarina->purgeByXSS($_POST['robots']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 24).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && (($ocarina->username[0]->grado < 3) || ($ocarina->username[0]->grado == 5))) {
	if(!$submit) {
		$robots = '';
		if(file_exists($ocarina->config[0]->root_index.'/robots.txt')) {
			$f = fopen($ocarina->config[0]->root_index.'/robots.txt', 'r');
			$robots .= fread($f, filesize($ocarina->config[0]->root_index.'/robots.txt'));
			fclose($f);
			$ocarina->addValue('robots', str_replace('{$date}', date('d-m-y'), $ocarina->getLanguage('robots', 0)).'
User-agent: *
Disallow: 
Sitemap: '.$ocarina->config[0]->url_index.'/sitemap.php');
		}
		else
			$ocarina->addValue('robots', str_replace('{$date}', date('d-m-y'), $ocarina->getLanguage('robots', 0)).'
'.$robots);
	}
	else {
		$f = fopen($ocarina->config[0]->root_index.'/robots.txt', 'w');
		fwrite($f, $robots);
		fclose($f);
	}
}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('robots.tpl');
