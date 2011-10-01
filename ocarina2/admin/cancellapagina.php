<?php
/**
	/admin/cancellapagina.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');

$ocarina = new Ocarina();
$minititolo_pagina = ((isset($_POST['content'])) && (trim($_POST['content']) !== '')) ? $ocarina->purge($_POST['content']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = 'admin';
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 13).$ocarina->getLanguage('title', 2).$ocarina->getLanguage('title', 10).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);

if(($ocarina->isLogged()) && ($ocarina->username[0]->grado < 3))
	if(!$submit)
		$ocarina->addValue('content', $ocarina->searchPage('', 'wildcard'));
	else
		if($minititolo_pagina !== '')
			if($ocarina->deletePage($minititolo_pagina)) {
				$ocarina->addValue('result', $ocarina->getLanguage('deletepage', 0));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deleted.');
			}
			else {
				$ocarina->addValue('result', $ocarina->getLanguage('deletepage', 1));
				if($ocarina->config[0]->log == 1)
					$ocarina->log($ocarina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
			}
		else {
			$ocarina->addValue('result', $ocarina->getLanguage('deletepage', 2));
			if($ocarina->config[0]->log == 1)
				$ocarina->log($ocarina->username[0]->nickname, 'Page \''.$minititolo_pagina.'\' deletion failed.');
		}
else
	$ocarina->addValue('result', $ocarina->getLanguage('error', 4));
$ocarina->addValue('submit', $submit);
$ocarina->addValue('whatis', 'pagina');
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('deletecontent.tpl');
