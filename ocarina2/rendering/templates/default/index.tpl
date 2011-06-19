{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if is_array($contenuto)}
	{foreach from=$contenuto key=key item=item}
	{if $contenuto[$key]->approvato == 1}
	<div id="titolo"><a href="news.php?titolo={$contenuto[$key]->minititolo}">{$contenuto[$key]->titolo}</a></div>
	<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$contenuto[$key]->autore}">{$contenuto[$key]->autore}</a> il giorno {$contenuto[$key]->data} alle ore {$contenuto[$key]->ora} nella categoria <a href="categoria.php?cat={$contenuto[$key]->categoria}">{$contenuto[$key]->categoria}</a>.</div><br />
	<div id="news">{$contenuto[$key]->contenuto}</div>
	<div align="right"><a href="news.php?titolo={$contenuto[$key]->minititolo}">Lascia un commento</a></div>
	<hr />
	{/if}
	{/foreach}
	<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="?p={$pagina}">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b>{else}<a href="?p={$pagina}">{$pagina}</a> | {/if}{/foreach}</div>
	{else}
	<div id="titolo">{$contenuto}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
