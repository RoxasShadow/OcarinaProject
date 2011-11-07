{*	/rendering/templates/zen/archivio.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<h2>{$error}</h2>
	{else}
		{if !isset($news) AND isset($error_news)}
			<h2>{$error_news}</h2>
		{elseif isset($news)}
			<h2>News <a href="{$url_index}/feed/news.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></h2>
			{foreach from=$news key=key item=item}
				&raquo; <a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a> ({$news[$key]->visite} visite)<br />
			{/foreach}
		{/if}
		<hr />
		{if !isset($pagine) AND isset($error_page)}
			<h2>{$error_page}</h2>
		{elseif isset($news)}
			<h2>Pagine <a href="{$url_index}/feed/page.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></h2>
			{foreach from=$pagine key=key item=item}
				&raquo; <a href="{$url_index}/page/{$pagine[$key]->minititolo}.html">{$pagine[$key]->titolo}</a> ({$pagine[$key]->visite} visite)<br />
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
