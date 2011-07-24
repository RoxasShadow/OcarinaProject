{*	/rendering/templates/default/commento.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<div class="titolo">{$error}</div>
	{else}
		{if isset($commento)}
			{foreach from=$commento key=key item=item}
				<div class="titolo">Commento #{$commento[$key]->id}</div>
				<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$commento[$key]->autore}.html">{$commento[$key]->autore}</a> il giorno {$commento[$key]->data} alle ore {$commento[$key]->ora}.(<a href="{$url_index}/news/{$commento[$key]->news}.html">News originale</a>)</div><br />
				<div class="news">{$commento[$key]->contenuto}</div>
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
