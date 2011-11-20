{*	/rendering/templates/razor/commento.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<section><div class="notice">{$error}</div></section>
	{else}
		{if isset($commento)}
			<section>
			<header>
			<h2>Commento #{$commento[0]->id}</h2>
			<h3>Scritto da <a href="{$url_index}/profile/{$commento[0]->autore}.html">{$commento[0]->autore}</a> il giorno {$commento[0]->data} alle ore {$commento[0]->ora}.(<a href="{$url_index}/news/{$commento[0]->news}.html">News originale</a>)</h3>
			</header>
			<article>
			<p>{$commento[0]->contenuto}</p>
			</article>
			</section>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
