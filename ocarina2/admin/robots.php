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
$rendering->addValue('titolo', 'Robots &raquo; Amministrazione &raquo; '.$user->config[0]->nomesito);

if(($user->isLogged()) && (($user->username[0]->grado < 3) || ($user->username[0]->grado == 5))) {
	if(!$submit) {
		$robots = '';
		if(file_exists($user->config[0]->root_index.'/robots.txt')) {
			$f = fopen($user->config[0]->root_index.'/robots.txt', 'r');
			$robots .= fread($f, filesize($user->config[0]->root_index.'/robots.txt'));
			fclose($f);
			$rendering->addValue('robots', '# Robots generato il '.date('d-m-y').' tramite Ocarina CMS.
User-agent: *
Disallow: 
Sitemap: '.$user->config[0]->url_index.'/sitemap.php');
		}
		else
			$rendering->addValue('robots', '# Robots generato il '.date('d-m-y').' tramite Ocarina CMS.
'.$robots);
	}
	if($submit) {
		$f = fopen($user->config[0]->root_index.'/robots.txt', 'w');
		fwrite($f, $robots);
		fclose($f);
	}
}
else
	$rendering->addValue('result', 'Accesso negato.');
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('robots.tpl');
