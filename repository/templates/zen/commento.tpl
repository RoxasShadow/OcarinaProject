{*	/rendering/templates/zen/commento.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<h2>{$error}</h2>
	{else}
		{if isset($commento)}
			<h2>Commento #{$commento[0]->id}</h2>
			<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$commento[0]->autore}.html">{$commento[0]->autore}</a> il giorno {$commento[0]->data} alle ore {$commento[0]->ora}.(<a href="{$url_index}/news/{$commento[0]->news}.html">News originale</a>)</div><br />
			<div class="news">{$commento[0]->contenuto}</div>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
