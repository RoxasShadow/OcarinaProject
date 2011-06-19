{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div id="titolo">{$errore}</div>
	{else}
		{if is_array($news)}
			{foreach from=$news key=key item=item}
				{if $news[$key]->approvato == 1}
					<div id="titolo"><a href="news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a></div>
					<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$news[$key]->autore}">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="categoria.php?cat={$news[$key]->categoria}">{$news[$key]->categoria}</a>.</div><br />
					<div id="news">{$news[$key]->contenuto}</div>
					<div align="right"><a href="news.php?titolo={$news[$key]->minititolo}">Lascia un commento</a></div>
					<hr />
				{/if}
			{/foreach}
			<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="?p={$pagina}">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="?p={$pagina}">{$pagina}</a></b>{else}<a href="?p={$pagina}">{$pagina}</a> | {/if}{/foreach}</div>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
