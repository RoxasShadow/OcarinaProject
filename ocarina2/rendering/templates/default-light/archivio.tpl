{*	/rendering/templates/default/archivio.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else}
		{if !isset($news) AND isset($errore_news)}
			<div class="titolo">{$errore_news}</div>
		{elseif isset($news)}
			&bull; <b>News</b><br />
			{foreach from=$news key=key item=item}
				{if $news[$key]->approvato == 1}
					&raquo; <a href="{$url_index}/news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a><br />
				{/if}
			{/foreach}
		{/if}
		<hr />
		{if !isset($pagine) AND isset($errore_pagine)}
			<div class="titolo">{$errore_pagine}</div>
		{elseif isset($news)}
			&bull; <b>Pagine</b><br />
			{foreach from=$pagine key=key item=item}
				{if $pagine[$key]->approvato == 1}
					&raquo; <a href="{$url_index}/pagina.php?titolo={$pagine[$key]->minititolo}">{$pagine[$key]->titolo}</a><br />
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
