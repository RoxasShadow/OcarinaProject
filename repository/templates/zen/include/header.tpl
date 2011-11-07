{*	/rendering/templates/zen/header.tpl
	(C) Giovanni Capuano 2011
*}
<!DOCTYPE html>
<html>
<head>
<title>{$titolo}</title>
<meta charset="UTF-8" />
{if ((isset($description)) && ($description !== ''))}<meta name="description" content="{$description}" />{/if}
<link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/style.css" />
<script type="text/javascript" src="{$url_index}/etc/loadJavascript.js.php"></script>
<link rel="alternate" type="application/rss+xml" title="Feed RSS News" href="{$url_index}/feed/news.html" />
<link rel="alternate" type="application/rss+xml" title="Feed RSS Pagine" href="{$url_index}/feed/page.html" />
<meta name="robots" content="index,follow" />
{$head}
</head>
<body>
<a target="_blank" href="http://www.giovannicapuano.net/ocarina/"><div id="logo"></div></a>
<div id="menu">
     {$menu}
     <div class="element"><a href="{$url_index}/index.php"><i>Home</i></a></div>
     <div class="element"><a href="{$url_index}/archivio.php">Archivio</a></div>
     <div class="element"><a href="{$url_index}/ricerca.php">Cerca nel sito</a></div>
     <div class="element"><a href="{$url_index}/profilo.php">Profili</a></div>
     {$postmenu}
     <div style="clear:both"></div>
     <div id="welcome">
	{if $utente == ''}
	Benvenuto su {$nomesito}! Per usufruire di tutte le funzionalità che ti offriamo <a href="{$url_index}/login.php">accedi</a> oppure <a href="{$url_index}/registrazione.php">registrati</a>. (<a href="{$url_index}/recuperapassword.php">Password persa?</a>)
	{else}
	Bentornato {$utente} (<a href="{$url_index}/logout.php">Logout</a> | <a href="{$url_index}/mp.php">{$numeromp}</a> MP | <a href="{$url_index}/inviamp.php">Invia MP</a> | <a href="{$url_index}/profile/{$utente}.html">Profilo</a> | <a href="{$url_index}/modificaprofilo.php">Modifica profilo</a> | <a href="{$url_index}/modificapassword.php">Modifica password</a>)
	{/if}
     </div>
     <div style="clear:both"></div>
</div>
<div id="body">
{$body}
