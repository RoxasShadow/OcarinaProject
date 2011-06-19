<?php /* Smarty version Smarty-3.0.8, created on 2011-06-18 20:38:47
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10188707624dfd0cd78f79c6-69811764%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70e400fd0b2e7acecca3489bbec7bda2382e1f0c' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/header.tpl',
      1 => 1308429021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10188707624dfd0cd78f79c6-69811764',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<title><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</title>
	<meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
" />
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/style.css" />
	<meta name="robots" content="index,follow" />
</head>
<body>
	<div id="header"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</div>
	<div id="menu" align="center">
	<a href="Aindex.php">News</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a><br />
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
