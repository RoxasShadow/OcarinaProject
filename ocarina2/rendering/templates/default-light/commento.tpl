{*	/rendering/templates/default/commento.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else}
		{if isset($commento)}
			{foreach from=$commento key=key item=item}
				{if $commento[$key]->approvato == 1}
					<div class="titolo">Commento #{$commento[$key]->id}</div>
					<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profilo.php?nickname={$commento[$key]->autore}">{$commento[$key]->autore}</a> il giorno {$commento[$key]->data} alle ore {$commento[$key]->ora}.(<a href="{$url_index}/news.php?titolo={$commento[$key]->news}">News originale</a>)</div><br />
					<div class="news">{$commento[$key]->contenuto}</div>
				{else}
					Il commento non è stato approvato, e quindi non è visibile.
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
