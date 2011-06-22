<?php /* Smarty version Smarty-3.0.8, created on 2011-06-22 23:19:53
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default copiato asd/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5728499364e027899460c79-72878740%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6200b202a286b4b944105bc30ed3f0581d5abf43' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default copiato asd/include/header.tpl',
      1 => 1308784749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5728499364e027899460c79-72878740',
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
 (Anche se non sembra è una nuova skin asd)</div>
	<div id="menu" align="center">
	<a href="Aindex.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Cerca nel sito</a> | <a href="profilo.php">Profili</a> | <a href="#">Filler</a><br />
	<?php if ($_smarty_tpl->getVariable('utente')->value==''){?>
		Benvenuto su <?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
! Per usufruire di tutte le funzionalità che ti offriamo <a href="login.php">accedi</a> oppure <a href="registrazione.php">registrati</a>. (<a href="recuperapassword.php">Password persa?</a>)
	<?php }else{ ?>
		Bentornato <?php echo $_smarty_tpl->getVariable('utente')->value;?>
 (<a href="logout.php">Logout</a> | <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('utente')->value;?>
">Profilo</a> | <a href="modificaprofilo.php">Modifica profilo</a> | <a href="modificapassword.php">Modifica password</a>)
	<?php }?>
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
