<?php /* Smarty version Smarty-3.0.8, created on 2011-06-19 12:55:09
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14655372234dfdf1ad2fe039-33642803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cd30aac40a119258fa7385e7e04e4d3860ad49b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/include/header.tpl',
      1 => 1308488106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14655372234dfdf1ad2fe039-33642803',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<title><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
" />
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/style.css" />
	<meta name="robots" content="index,follow" />
</head>
<body>
	<div id="header"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</div>
	<div id="menu" align="center">
	<a href="Aindex.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Cerca nel sito</a> | <a href="#">Filler</a> | <a href="#">Filler</a><br />
	Bentornato <?php echo $_smarty_tpl->getVariable('utente')->value;?>
 (<a href="admin/logout.php">Logout</a> | <a href="admin/profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('utente')->value;?>
">Profilo</a>)
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
