{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div id="titolo">{$errore}</div>
	{else}
		{if is_array($commento)}
			{foreach from=$commento key=key item=item}
				{if $commento[$key]->approvato == 1}
					<div id="titolo">Commento #{$commento[$key]->id}</div>
					<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$commento[$key]->autore}">{$commento[$key]->autore}</a> il giorno {$commento[$key]->data} alle ore {$commento[$key]->ora}. <a href="news.php?titolo={$commento[$key]->news}">Vai qui per la news</a>.</div><br />
					<div id="news">{$commento[$key]->contenuto}</div>
				{else}
					Il commento non è stato approvato, e quindi non è visibile.
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
