<?php
/**
	/admin/preview.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../etc/class.BBCode.php');

$user = new User();
$bbcode = new BBCode();
$text = ((isset($_GET['text'])) && ($_GET['text'] !== '')) ? $user->purgeByXSS($_GET['text']) : '';

if(($user->isLogged()) && ($user->username[0]->grado < 4)) {
	if($user->config[0]->bbcode == 1)
		$text = $bbcode->bbcode($text);
	echo $text;
}
