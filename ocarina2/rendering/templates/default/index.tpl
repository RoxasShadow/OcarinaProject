<html>
<head>
	<title>{$titolo}</title>
	<meta name="description" content="{$description}" />
	<meta name="keywords" content="{$keywords}" />
	<link rel="stylesheet" type="text/css" href="http://www.giovannicapuano.net/rendering/templates/dark/resources/style.css" />
	<meta name="robots" content="index,follow" />
</head>
<body>
	<div id="header">{$titolo}</div>
	<div id="menu" align="center">
	<a href="index.php">News</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a><br />
	Bentornato {$utente} (<a href="admin/logout.php">Logout</a> | <a href="admin/profilo.php?nickname={$utente}">Profilo</a>)
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
	{if is_array($contenuto)}	 
		{foreach from=$contenuto key=key item=item}
			<div id="titolo">{$contenuto[$key]->titolo}</div>
			<div id="newsheader" align="center">Scritto il giorno {$contenuto[$key]->data} alle ore {$contenuto[$key]->ora} nella categoria 			<a href="categoria.php?cat={$contenuto[$key]->categoria}">{$contenuto[$key]->categoria}</a>.</div><br />
			<div id="news">{$contenuto[$key]->contenuto}</div>
			<div align="right"><a href="news.php?titolo={$contenuto[$key]->minititolo}">Lascia un commento</a></div>
			<hr />
		{/foreach}
		<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="?p={$pagina}">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b>{else}<a href="?p={$pagina}">{$pagina}</a> | {/if}{/foreach}</div>
	{else}
		<div id="titolo">{$contenuto}</div>
	{/if}
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	</table>
</body>
</html>
