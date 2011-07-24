{*	/rendering/templates/default/ricerca.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $cerca}
		Cerca tra le news:<br />
		<form action="" method="post">
		<input type="text" name="news" /><input type="submit" value="Cerca" name="submitNews" />
		</form>
		<br />
		Cerca tra le pagine:<br />
		<form action="" method="post">
		<input type="text" name="pagine" /><input type="submit" value="Cerca" name="submitPage" />
		</form>
		<br />
		Cerca tra i commenti:<br />
		<form action="" method="post">
		<input type="text" name="commenti" /><input type="submit" value="Cerca" name="submitComment" />
		</form>
	{else}
	
	{if isset($error_news)}
		<div class="titolo">{$error_news}</div>
	{else if isset($news)}
		&bull; <b>News</b><br />
		{foreach from=$news key=key item=item}
			&raquo; <a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a><br />
		{/foreach}
	{/if}
	
	{if isset($error_page)}
		<div class="titolo">{$error_page}</div>
	{else if isset($pagina)}
		&bull; <b>Pagine</b><br />
		{foreach from=$pagina key=key item=item}
			&raquo; <a href="{$url_index}/page/{$pagina[$key]->minititolo}.html">{$pagina[$key]->titolo}</a><br />
		{/foreach}
	{/if}
	
	{if isset($error_comment)}
		<div class="titolo">{$error_comment}</div>
	{else if isset($commento)}
		&bull; <b>Commenti</b><br />
		{foreach from=$commento key=key item=item}
			&raquo; <a href="{$url_index}/comment/{$commento[$key]->id}.html">#{$commento[$key]->id} - {$commento[$key]->autore}</a><br />
		{/foreach}
	{/if}
	
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
