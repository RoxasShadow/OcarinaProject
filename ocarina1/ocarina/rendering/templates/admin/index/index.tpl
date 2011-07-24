<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" http://www.w3.org/TR/html4/loose.dtd>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>{$titolo} &raquo; Ocarina - {$cmsversion}</title>

<link href="{$url_smartytpl}admin/resources/css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="{$url_smartytpl}admin/resources/css/ie6.css" /><![endif]-->

<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="{$url_smartytpl}admin/resources/css/ie7.css" /><![endif]-->

<script type="text/javascript" src="{$url_smartytpl}admin/resources/js/jquery.js"></script>

<script type="text/javascript" src="{$url_smartytpl}admin/skin/clean/style/js/jNice.js"></script>

</head>



<body>

<div id="wrapper">

<h1><a href="#"><span>Admin - {$cmsversion} - {$titolo}</span></a></h1>

<div id="containerHolder">

<div id="container">

<div id="sidebar">

<ul class="sideNav">

	{if $cookie eq 1 or $cookie eq 2}   

<li><a class="active">Amministrazione</a></li>

<li><a href="{$url_cms}modificapassword.php">Modifica password</a></li>

<li><a href="{$url_cms}modificaprofilo.php">Modifica profilo</a></li>

<li><a href="{$url_cms}logout.php">Logout</a></li>

<li><a href="{$url_cms}profilo.php">Profilo</a></li>

<li><a href="{$url_cms}listautenti.php">Lista utenti</a></li>

	{/if}
	{if $cookie eq 2} 




<li><a class="active">SEO</a></li>

<li><a href="{$url_cms}utility/aggiornasitemap.php">Aggiorna Sitemap</a></li>

<li><a href="{$url_cms}utility/modificarobots.php">Modifica robots</a></li>



<li><a class="active">Utenti</a></li>

<li><a href="{$url_cms}utility/modificagrado.php">Modifica grado utente</a></li>

<li><a href="{$url_cms}utility/newsletter.php">Invia newsletter</a></li>



<li><a class="active">Annunci Staff</a></li>

<li><a href="{$url_cms}annunci/">Annunci</a></li>

<li><a href="{$url_cms}annunci/cancellaannuncio.php">Cancella annuncio</a></li>

<li><a href="{$url_cms}annunci/creaannuncio.php">Crea annuncio</a></li>



<li><a class="active">News</a></li>

<li><a href="{$url_cms}news/creanews.php">Crea news</a></li>

<li><a href="{$url_cms}news/cancellanews.php">Cancella news</a></li>

<li><a href="{$url_cms}news/modificanews.php">Modifica news</a></li>

<li><a href="{$url_cms}news/creacategoria.php">Crea categoria</a></li>

<li><a href="{$url_cms}news/eliminacategoria.php">Elimina categoria</a></li>

<li><a href="{$url_cms}commenti/moderacommento.php">Modera commenti</a></li>

<li><a href="{$url_cms}commenti/ultimicommenti.php">Ultimi commenti</a></li>



<li><a class="active">Sezioni</a></li>

<li><a href="{$url_cms}sezioni/creasezione.php">Crea sezione</a></li>

<li><a href="{$url_cms}sezioni/cancellasezione.php">Cancella sezione</a></li>

<li><a href="{$url_cms}sezioni/modificasezione.php">Modifica sezione</a></li>

<li><a href="{$url_cms}sezioni/creacategoria.php">Crea categoria</a></li>

<li><a href="{$url_cms}sezioni/eliminacategoria.php">Elimina categoria</a></li>



<li><a class="active">Uploader Immagini</a></li>

<li><a href="{$url_cms}uploader/upload.php">Carica immagini</a></li>

<li><a href="{$url_cms}uploader/elencoimmagini.php">Elenco immagini</a></li> 

 

<li><a class="active">Webdesign</a></li>

<li><a href="{$url_cms}webdesign/installaskin.php">Installa skin</a></li>

<li><a href="{$url_cms}webdesign/modificaskin.php">Modifica skin</a></li>



	{elseif $cookie eq 0}   



<li><a class="active">Amministrazione</a></li>

<li><a href="{$url_cms}login.php">Login</a></li>

<li><a href="{$url_cms}registrazione.php">Registrazione</a></li>

<li><a href="{$url_cms}recuperapassword.php">Recupera password</a></li>

<li><a href="{$url_cms}profilo.php">Profilo</a></li>

<li><a href="{$url_cms}listautenti.php">Lista utenti</a></li>

	{/if}   



</ul>

</div>    



<h2><a href="{$url_cms}">Ocarina - {$cmsversion}</a> &raquo; <a href="#" class="active">{$titolo}</a></h2>

<div id="main">

<br /><br />

{if $cookie eq 2}
{$contents}
{elseif $cookie eq 0 or $cookie eq 1}
Non hai i permessi per navigare qui.
{else}
Non hai i permessi per navigare qui.<br />
Ciò può derivare dal fatto che non hai ancora effettuato l'accesso.
{/if}

<br /><br /></div>

<div class="clear"></div>

</div>

</div>	

</div>



<p align="center" style="font-size:1px;">

&copy; 2010<br />

<a href="http://www.giovannicapuano.net/ocarina/">Ocarina</a> - {$cmsversion}</font>

</body>

</html>
