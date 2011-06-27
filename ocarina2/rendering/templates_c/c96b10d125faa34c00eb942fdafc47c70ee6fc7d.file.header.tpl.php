<?php /* Smarty version Smarty-3.0.8, created on 2011-06-26 12:39:14
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/adminf/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:309547474e0728725fa897-47209323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c96b10d125faa34c00eb942fdafc47c70ee6fc7d' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/adminf/include/header.tpl',
      1 => 1309091727,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309547474e0728725fa897-47209323',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" http://www.w3.org/TR/html4/loose.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/ie7.css" /><![endif]-->
</head>
<body>
	<div id="wrapper">
	<h1><a href="#"><span><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</span></a></h1>
	<div id="containerHolder">
	<div id="container">
	<div id="sidebar">
	<ul class="sideNav">
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''||$_smarty_tpl->getVariable('grado')->value<5){?>
		<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">Login</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value>5){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==5){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
		<li><a class="active">SEO</a></li>
		<li><a href="#">Filler ~</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==4){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
		<li><a class="active">Webdesign</a></li>
		<li><a href="#">Filler ~</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==3){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
		<li><a class="active">News</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==2){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
		<li><a class="active">Utenti</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">News</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==1){?>
		<li><a class="active">Amministrazione</a></li>
		<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
		<li><a class="active">SEO</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Utenti</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">News</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Webdesign</a></li>
		<li><a href="#">Filler ~</a></li>
	<?php }?>
	</ul>
	</div>
	<h2><a class="active"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</a></h2>
	<div id="main">
	<br /><br />
