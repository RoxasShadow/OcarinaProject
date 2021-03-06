{*	/rendering/templates/zen/ricerca.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	<div id="post-0" class="post">
	{if $cerca}
		Cerca tra le news:<br />
		<form action="" method="get">
		<input type="search" name="news" /><input type="submit" value="Cerca" />
		</form>
		<br />
		Cerca tra le pagine:<br />
		<form action="" method="get">
		<input type="search" name="pagine" /><input type="submit" value="Cerca" />
		</form>
		<br />
		Cerca tra i commenti:<br />
		<form action="" method="get">
		<input type="search" name="commenti" /><input type="submit" value="Cerca" />
		</form>
	{else}
	
	{if isset($error_news)}
		<h2 class="title">{$error_news}</h2>
	{else if isset($news)}
		<h2>News</h2>
		{foreach from=$news key=key item=item}
			&raquo; <a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a><br />
		{/foreach}
	{/if}
	
	{if isset($error_page)}
		<h2 class="title">{$error_page}</h2>
	{else if isset($pagina)}
		<h2>Pagine</h2>
		{foreach from=$pagina key=key item=item}
			&raquo; <a href="{$url_index}/page/{$pagina[$key]->minititolo}.html">{$pagina[$key]->titolo}</a><br />
		{/foreach}
	{/if}
	
	{if isset($error_comment)}
		<h2 class="title">{$error_comment}</h2>
	{else if isset($commento)}
		<h2>Commenti</h2>
		{foreach from=$commento key=key item=item}
			&raquo; <a href="{$url_index}/comment/{$commento[$key]->id}.html">#{$commento[$key]->id} - {$commento[$key]->autore}</a><br />
		{/foreach}
	{/if}
	
	{/if}
	</div>
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
