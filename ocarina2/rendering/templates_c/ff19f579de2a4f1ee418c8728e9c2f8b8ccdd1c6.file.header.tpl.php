<?php /* Smarty version Smarty-3.0.8, created on 2011-08-02 17:01:20
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16316045354e382d601630e8-62921417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff19f579de2a4f1ee418c8728e9c2f8b8ccdd1c6' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/include/header.tpl',
      1 => 1311965116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16316045354e382d601630e8-62921417',
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
<?php if (((isset($_smarty_tpl->getVariable('description',null,true,false)->value))&&($_smarty_tpl->getVariable('description')->value!==''))){?><meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" /><?php }?>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/style.css" />
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/etc/loadJavascript.js.php"></script>
<link rel="alternate" type="application/rss+xml" title="Feed RSS News" href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/feed/news.html" />
<link rel="alternate" type="application/rss+xml" title="Feed RSS Pagine" href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/feed/page.html" />
<meta name="robots" content="index,follow" />
</head>
<body>
<div id="header"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</div>
<div id="menu" align="center">
<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/index.php">News</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/archivio.php">Archivio</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/ricerca.php">Cerca nel sito</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profilo.php">Profili</a><br />
<?php if ($_smarty_tpl->getVariable('utente')->value==''){?>
Benvenuto su <?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
! Per usufruire di tutte le funzionalità che ti offriamo <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">accedi</a> oppure <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/registrazione.php">registrati</a>. (<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/recuperapassword.php">Password persa?</a>)
<?php }else{ ?>
Bentornato <?php echo $_smarty_tpl->getVariable('utente')->value;?>
 (<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/mp.php"><?php echo $_smarty_tpl->getVariable('numeromp')->value;?>
</a> MP | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/inviamp.php">Invia MP</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('utente')->value;?>
.html">Profilo</a> | <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/modificaprofilo.php">Modifica profilo</a> | <a href="modificapassword.php">Modifica password</a>)
<?php }?>
</div>
<br />
<table id="colunica">
<tr>
<td>
<table style="width:50%; margin-left:auto; margin-right:auto;">
<tr>
<td style="width:50%">
