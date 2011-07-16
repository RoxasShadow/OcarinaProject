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
$text = ((isset($_GET['text'])) && ($_GET['text'] !== '')) ? $user->purgeByXSS($_GET['text']) : '';
$text = preg_replace('/\v+|\\\[rn]/', '<br/>', $text);

if($user->config[0]->bbcode == 1)
	if($type == 'comment')
		$text = $bbcode->bbcodecommenti($text);
	else
		$text = $bbcode->bbcode($text);
echo $text;
