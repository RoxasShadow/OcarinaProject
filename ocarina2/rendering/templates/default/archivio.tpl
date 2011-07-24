{*	/rendering/templates/default/archivio.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$error}</div>
	{else}
		{if !isset($news) AND isset($error_news)}
			<div class="titolo">{$error_news}</div>
		{elseif isset($news)}
			&bull; <b>News</b> <a href="{$url_index}/feed/news.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a><br />
			{foreach from=$news key=key item=item}
				&raquo; <a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a> ({$news[$key]->visite} visite)<br />
			{/foreach}
		{/if}
		<hr />
		{if !isset($pagine) AND isset($error_page)}
			<div class="titolo">{$error_page}</div>
		{elseif isset($news)}
			&bull; <b>Pagine <a href="{$url_index}/feed/page.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></b><br />
			{foreach from=$pagine key=key item=item}
				&raquo; <a href="{$url_index}/page/{$pagine[$key]->minititolo}.html">{$pagine[$key]->titolo}</a> ({$pagine[$key]->visite} visite)<br />
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
