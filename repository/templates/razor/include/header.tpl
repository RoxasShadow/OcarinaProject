{*	/rendering/templates/razor/header.tpl
	(C) Giovanni Capuano 2011
*}
<!DOCTYPE html>
<html>
<head>
<title>{$titolo}</title>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
{if ((isset($description)) && ($description !== ''))}<meta name="description" content="{$description}" />{/if}
<link rel="stylesheet" type="text/css" media="print" href="{$url_rendering}/templates/{$skin}/resources/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="{$url_rendering}/templates/{$skin}/resources/screen.css" />
<!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/ie.css" /><![endif]-->
<link rel="stylesheet" type="text/css" media="screen, projection" href="{$url_rendering}/templates/{$skin}/resources/style.css" />
<script type="text/javascript" src="{$url_index}/etc/loadJavascript.js.php"></script>
<link rel="alternate" type="application/rss+xml" title="Feed RSS News" href="{$url_index}/feed/news.html" />
<link rel="alternate" type="application/rss+xml" title="Feed RSS Pagine" href="{$url_index}/feed/page.html" />
<meta name="robots" content="index,follow" />
{$head}
</head>
<body>
<div class="container">
<h2 class="alt center">{$titolo}</h2>
<nav>
{$menu}
<h3 class="alt center">
<a href="{$url_index}/index.php">News</a> | <a href="{$url_index}/archivio.php">Archivio</a> | <a href="{$url_index}/ricerca.php">Cerca nel sito</a> | <a href="{$url_index}/profilo.php">Profili</a>
</h3>
{if $utente == ''}
<h4 class="alt center">Benvenuto su {$nomesito}! Per usufruire di tutte le funzionalità che ti offriamo <a href="{$url_index}/login.php">accedi</a> oppure <a href="{$url_index}/registrazione.php">registrati</a>. (<a href="{$url_index}/recuperapassword.php">Password persa?</a>)</h4>
{else}
<h4 class="alt center">Bentornato {$utente} (<a href="{$url_index}/logout.php">Logout</a> | <a href="{$url_index}/mp.php">{$numeromp}</a> MP | <a href="{$url_index}/inviamp.php">Invia MP</a> | <a href="{$url_index}/profile/{$utente}.html">Profilo</a> | <a href="{$url_index}/modificaprofilo.php">Modifica profilo</a> | <a href="{$url_index}/modificapassword.php">Modifica password</a>)</h4>
{/if}
{$postmenu}
</nav>
<br />
<div class="span-24" id="contents">
{$body}
