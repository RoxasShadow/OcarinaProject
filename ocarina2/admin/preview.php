<?php
/**
	/admin/preview.php
	(C) Giovanni Capuano 2011
*/
require_once('../core/class.Ocarina.php');
require_once('../etc/class.BBCode.php');

$ocarina = new Ocarina();
$bbcode = new BBCode();
$type = ((isset($_GET['type'])) && ($_GET['type'] !== '')) ? $ocarina->purgeByXSS($_GET['type']) : '';
$text = ((isset($_POST['text'])) && ($_POST['text'] !== '')) ? $ocarina->purgeByXSS($_POST['text']) : die('Text not found.');

if($ocarina->config[0]->bbcode == 1)
	if($type == 'comment')
		echo $bbcode->bbcodecommenti($text);
	else
		echo $bbcode->bbcode($text);
