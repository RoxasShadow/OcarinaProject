{*	rendering/templates/admin/header.tpl
	(C) Giovanni Capuano 2011
*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$titolo}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/reset.css" />
<link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/layout.css" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/ie7.css" /><![endif]-->
<script type="text/javascript" src="{$url_index}/etc/loadJavascript.js.php"></script>
{$head}
</head>
<body>
{if ((isset($grado)) && ($grado == 1) && isset($lastversion) && isset($versione) && ($lastversion > $versione))}
	<div align="center">Stai usando una versione vecchia di Ocarina2: <a href="http://www.giovannicapuano.net/ocarina2/index.php">aggiorna subito!</a></div>
{/if}
<div id="wrapper">
<h1><a href="#"><span>{$titolo}</span></a></h1>
<div id="containerHolder">
<div id="container">
<div id="sidebar">
<ul class="sideNav">
{$menu}
{if ((!isset($grado)) || ($grado == ''))}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/login.php">Login</a></li>
{elseif $grado > 5}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
{elseif $grado == 5}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
<li><a href="{$url_admin}/log.php">Logs</a></li>
<li><a href="{$url_admin}/annunci.php">Annunci</a></li>
<li><a class="active">SEO</a></li>
<li><a href="{$url_admin}/robots.php">Robots</a></li>
{elseif $grado == 4}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
<li><a href="{$url_admin}/log.php">Logs</a></li>
<li><a href="{$url_admin}/annunci.php">Annunci</a></li>
<li><a class="active">Webdesign</a></li>
<li><a href="{$url_admin}/installaskin.php">Installa skin</a></li>
<li><a href="{$url_admin}/disinstallaskin.php">Disinstalla skin</a></li>
{elseif $grado == 3}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
<li><a href="{$url_admin}/log.php">Logs</a></li>
<li><a href="{$url_admin}/annunci.php">Annunci</a></li>
<li><a class="active">News</a></li>
<li><a href="{$url_admin}/creanews.php">Crea news</a></li>
<li><a href="{$url_admin}/modificanews.php">Modifica news</a></li>
<li><a href="{$url_admin}/cancellanews.php">Cancella news</a></li>
<li><a href="{$url_admin}/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="{$url_admin}/creapagina.php">Crea pagina</a></li>
<li><a href="{$url_admin}/modificapagina.php">Modifica pagina</a></li>
<li><a href="{$url_admin}/cancellapagina.php">Cancella pagina</a></li>
<li><a href="{$url_admin}/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="{$url_admin}/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="{$url_admin}/upload.php">Upload</a></li>
<li><a href="{$url_admin}/immagini.php">Immagini</a></li>
{elseif $grado == 2}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
<li><a href="{$url_admin}/log.php">Logs</a></li>
<li><a class="active">SEO</a></li>
<li><a href="{$url_admin}/robots.php">Robots</a></li>
<li><a class="active">Annunci</a></li>
<li><a href="{$url_admin}/annunci.php">Annunci</a></li>
<li><a href="{$url_admin}/creaannuncio.php">Crea annuncio</a></li>
<li><a href="{$url_admin}/modificaannuncio.php">Modifica annunci</a></li>
<li><a href="{$url_admin}/cancellaannuncio.php">Cancella annunci</a></li>
<li><a class="active">News</a></li>
<li><a href="{$url_admin}/creanews.php">Crea news</a></li>
<li><a href="{$url_admin}/modificanews.php">Modifica news</a></li>
<li><a href="{$url_admin}/cancellanews.php">Cancella news</a></li>
<li><a href="{$url_admin}/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="{$url_admin}/creapagina.php">Crea pagina</a></li>
<li><a href="{$url_admin}/modificapagina.php">Modifica pagina</a></li>
<li><a href="{$url_admin}/cancellapagina.php">Cancella pagina</a></li>
<li><a href="{$url_admin}/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="{$url_admin}/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="{$url_admin}/upload.php">Upload</a></li>
<li><a href="{$url_admin}/immagini.php">Immagini</a></li>
{elseif $grado == 1}
<li><a class="active">{$nomesito}</a></li>
<li><a href="{$url_index}/logout.php">Logout</a></li>
<li><a href="{$url_admin}/log.php">Logs</a></li>
<li><a href="{$url_admin}/configurazione.php">Configurazione</a></li>
<li><a class="active">SEO</a></li>
<li><a href="{$url_admin}/robots.php">Robots</a></li>
<li><a class="active">Annunci</a></li>
<li><a href="{$url_admin}/annunci.php">Annunci</a></li>
<li><a href="{$url_admin}/creaannuncio.php">Crea annuncio</a></li>
<li><a href="{$url_admin}/modificaannuncio.php">Modifica annunci</a></li>
<li><a href="{$url_admin}/cancellaannuncio.php">Cancella annunci</a></li>
<li><a class="active">Utenti</a></li>
<li><a href="{$url_admin}/modificagrado.php">Modifica grado</a></li>
<li><a href="{$url_admin}/cancellautente.php">Cancella utente</a></li>
<li><a href="{$url_admin}/newsletter.php">Newsletter</a></li>
<li><a class="active">News</a></li>
<li><a href="{$url_admin}/creanews.php">Crea news</a></li>
<li><a href="{$url_admin}/modificanews.php">Modifica news</a></li>
<li><a href="{$url_admin}/cancellanews.php">Cancella news</a></li>
<li><a href="{$url_admin}/approva.php">Approva news</a></li>
<li><a class="active">Pagine</a></li>
<li><a href="{$url_admin}/creapagina.php">Crea pagina</a></li>
<li><a href="{$url_admin}/modificapagina.php">Modifica pagina</a></li>
<li><a href="{$url_admin}/cancellapagina.php">Cancella pagina</a></li>
<li><a href="{$url_admin}/approva.php">Approva pagine</a></li>
<li><a class="active">Categorie</a></li>
<li><a href="{$url_admin}/gestiscicategorie.php">Gestisci categorie</a></li>
<li><a class="active">Uploader</a></li>
<li><a href="{$url_admin}/upload.php">Upload</a></li>
<li><a href="{$url_admin}/immagini.php">Immagini</a></li>
<li><a class="active">Webdesign</a></li>
<li><a href="{$url_admin}/installaskin.php">Installa skin</a></li>
<li><a href="{$url_admin}/disinstallaskin.php">Disinstalla skin</a></li>
{$postmenu}
{/if}
</ul>
</div>
<h2><a class="active">{$titolo}</a></h2>
<div id="main">
<br /><br />
{$body}
