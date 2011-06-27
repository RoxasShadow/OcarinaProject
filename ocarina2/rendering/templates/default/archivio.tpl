{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div id="titolo">{$errore}</div>
	{else}
		{if !isset($news) AND isset($errore_news)}
			<div id="titolo">{$errore_news}</div>
		{elseif isset($news)}
			&bull; <b>News</b><br />
			{foreach from=$news key=key item=item}
				{if $news[$key]->approvato == 1}
					&raquo; <a href="news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a><br />
				{/if}
			{/foreach}
		{/if}
		<hr />
		{if !isset($pagine) AND isset($errore_pagine)}
			<div id="titolo">{$errore_pagine}</div>
		{elseif isset($news)}
			&bull; <b>Pagine</b><br />
			{foreach from=$pagine key=key item=item}
				{if $pagine[$key]->approvato == 1}
					&raquo; <a href="pagina.php?titolo={$pagine[$key]->minititolo}">{$pagine[$key]->titolo}</a><br />
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
