<?php /* Smarty version Smarty-3.0.8, created on 2011-06-30 16:56:19
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6885914404e0caab39215c6-59794133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cd30aac40a119258fa7385e7e04e4d3860ad49b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/include/header.tpl',
      1 => 1309394368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6885914404e0caab39215c6-59794133',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
<a href="Aindex.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Cerca nel sito</a> | <a href="profilo.php">Profili</a> | <a href="#">Filler</a><br />
<?php if ($_smarty_tpl->getVariable('utente')->value==''){?>
Benvenuto su <?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
! Per usufruire di tutte le funzionalità che ti offriamo <a href="login.php">accedi</a> oppure <a href="registrazione.php">registrati</a>. (<a href="recuperapassword.php">Password persa?</a>)
<?php }else{ ?>
Bentornato <?php echo $_smarty_tpl->getVariable('utente')->value;?>
 (<a href="logout.php">Logout</a> | <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('utente')->value;?>
">Profilo</a> | <a href="modificaprofilo.php">Modifica profilo</a> | <a href="modificapassword.php">Modifica password</a>)
<?php }?>
</div>
<br />
<table id="colunica">
<tr>
<td>
<table style="width:50%; margin-left:auto; margin-right:auto;">
<tr>
<td style="width:50%">
