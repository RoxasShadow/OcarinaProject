<?php
/**
	/admin/preview.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.User.php');
require_once('../etc/class.BBCode.php');

$user = new User();
$bbcode = new BBCode();
$type = ((isset($_GET['type'])) && ($_GET['type'] !== '')) ? $user->purgeByXSS($_GET['type']) : '';
$text = ((isset($_POST['text'])) && ($_POST['text'] !== '')) ? $user->purgeByXSS($_POST['text']) : die('Text not found.');

if($user->config[0]->bbcode == 1)
	if($type == 'comment')
		echo $bbcode->bbcodecommenti($text);
	else
		echo $bbcode->bbcode($text);
