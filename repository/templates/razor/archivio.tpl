{*	/rendering/templates/razor/archivio.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<section><div class="notice">{$error}</div></section>
	{else}
		{if !isset($news) AND isset($error_news)}
			<section><div class="notice">{$error_news}</div></section>
		{elseif isset($news)}
			<section>
			<h5>News <a href="{$url_index}/feed/news.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></h5>
			<ul>
			{foreach from=$news key=key item=item}
				<li><a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a> ({$news[$key]->visite} visite)</li>
			{/foreach}
			</ul>
			</section>
		{/if}
		<hr />
		{if !isset($pagine) AND isset($error_page)}
			<section><div class="notice">{$error_page}</div></section>
		{elseif isset($news)}
			<section>
			<h5>Pagine <a href="{$url_index}/feed/page.html"><img src="{$url_rendering}/templates/{$skin}/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></h5>
			<ul>
			{foreach from=$pagine key=key item=item}
				<li><a href="{$url_index}/page/{$pagine[$key]->minititolo}.html">{$pagine[$key]->titolo}</a> ({$pagine[$key]->visite} visite)</li>
			{/foreach}
			</ul>
			</section>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
