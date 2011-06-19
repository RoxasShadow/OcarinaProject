{include file="$root_rendering/templates/$skin/include/header.tpl"}
	&bull; <b>News</b><br />
	{if is_array($news)}
	{foreach from=$news key=key item=item}
	{if $news[$key]->approvato == 1}
	{if $news@last}
	&raquo; <a href="news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a>
	{else}
	&raquo; <a href="news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a><br />
	{/if}
	{/if}
	{/foreach}</div>
	{else}
	<div id="titolo">{$news}</div>
	{/if}
	<hr />
	&bull; <b>Pagine</b><br />
	{if is_array($pagine)}
	{foreach from=$pagine key=key item=item}
	{if $pagine[$key]->approvato == 1}
	{if $pagine@last}
	&raquo; <a href="pagina.php?titolo={$pagine[$key]->minititolo}">{$pagine[$key]->titolo}</a>
	{else}
	&raquo; <a href="pagina.php?titolo={$pagine[$key]->minititolo}">{$pagine[$key]->titolo}</a><br />
	{/if}
	{/if}
	{/foreach}
	{else}
	<div id="titolo">{$pagine}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
