<?php /* Smarty version Smarty-3.0.8, created on 2011-07-23 12:39:13
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/include/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10761730554e2ac0f12b1cf0-47887631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06990b4356e1fa71f1be07210ace0be3ba5c771b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/include/header.tpl',
      1 => 1311424749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10761730554e2ac0f12b1cf0-47887631',
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/layout.css" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/ie7.css" /><![endif]-->
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/etc/loadJavascript.js.php"></script>
</head>
<body>
<?php if (((isset($_smarty_tpl->getVariable('grado',null,true,false)->value))&&($_smarty_tpl->getVariable('grado')->value==1)&&isset($_smarty_tpl->getVariable('lastversion',null,true,false)->value)&&isset($_smarty_tpl->getVariable('versione',null,true,false)->value)&&($_smarty_tpl->getVariable('lastversion')->value>$_smarty_tpl->getVariable('versione')->value))){?>
	<div align="center">Stai usando una versione vecchia di Ocarina2: <a href="http://www.giovannicapuano.net/ocarina2/index.php">aggiorna subito!</a></div>
<?php }?>
<div id="wrapper">
<h1><a href="#"><span><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</span></a></h1>
<div id="containerHolder">
<div id="container">
<div id="sidebar">
<ul class="sideNav">
<?php if (((!isset($_smarty_tpl->getVariable('grado',null,true,false)->value))||($_smarty_tpl->getVariable('grado')->value==''))){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">Login</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value>5){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value==5){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/log.php">Logs</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/annunci.php">Annunci</a></li>
<li><a class="active">SEO</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/robots.php">Robots</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value==4){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/log.php">Logs</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/annunci.php">Annunci</a></li>
<li><a class="active">Webdesign</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/installaskin.php">Installa skin</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/disinstallaskin.php">Disinstalla skin</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value==3){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/log.php">Logs</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/annunci.php">Annunci</a></li>
<li><a class="active">News</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creanews.php">Crea news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificanews.php">Modifica news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellanews.php">Cancella news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creapagina.php">Crea pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificapagina.php">Modifica pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellapagina.php">Cancella pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/upload.php">Upload</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/immagini.php">Immagini</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value==2){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/log.php">Logs</a></li>
<li><a class="active">SEO</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/robots.php">Robots</a></li>
<li><a class="active">Annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/annunci.php">Annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creaannuncio.php">Crea annuncio</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificaannuncio.php">Modifica annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellaannuncio.php">Cancella annunci</a></li>
<li><a class="active">News</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creanews.php">Crea news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificanews.php">Modifica news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellanews.php">Cancella news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creapagina.php">Crea pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificapagina.php">Modifica pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellapagina.php">Cancella pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/upload.php">Upload</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/immagini.php">Immagini</a></li>
<?php }elseif($_smarty_tpl->getVariable('grado')->value==1){?>
<li><a class="active"><?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/logout.php">Logout</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/log.php">Logs</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/configurazione.php">Configurazione</a></li>
<li><a class="active">SEO</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/robots.php">Robots</a></li>
<li><a class="active">Annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/annunci.php">Annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creaannuncio.php">Crea annuncio</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificaannuncio.php">Modifica annunci</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellaannuncio.php">Cancella annunci</a></li>
<li><a class="active">Utenti</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificagrado.php">Modifica grado</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellautente.php">Cancella utente</a></li>
<li><a class="active">News</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creanews.php">Crea news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificanews.php">Modifica news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellanews.php">Cancella news</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/creapagina.php">Crea pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/modificapagina.php">Modifica pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/cancellapagina.php">Cancella pagina</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/upload.php">Upload</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/immagini.php">Immagini</a></li>
<li><a class="active">Webdesign</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/installaskin.php">Installa skin</a></li>
<li><a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/disinstallaskin.php">Disinstalla skin</a></li>
<?php }?>
</ul>
</div>
<h2><a class="active"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</a></h2>
<div id="main">
<br /><br />
