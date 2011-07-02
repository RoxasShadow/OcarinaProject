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
			{if $news[$key]->approvato == 1}
				&raquo; <a href="{$url_index}/news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a><br />
			{/if}
		{/foreach}
	{/if}
	
	{if isset($error_page)}
		<div class="titolo">{$error_page}</div>
	{else if isset($pagina)}
		&bull; <b>Pagine</b><br />
		{foreach from=$pagina key=key item=item}
			{if $pagina[$key]->approvato == 1}
				&raquo; <a href="{$url_index}/pagina.php?titolo={$pagina[$key]->minititolo}">{$pagina[$key]->titolo}</a><br />
			{/if}
		{/foreach}
	{/if}
	
	{if isset($error_comment)}
		<div class="titolo">{$error_comment}</div>
	{else if isset($commento)}
		&bull; <b>Commenti</b><br />
		{foreach from=$commento key=key item=item}
			{if $commento[$key]->approvato == 1}
				&raquo; <a href="{$url_index}/commento.php?id={$commento[$key]->id}">#{$commento[$key]->id} - {$commento[$key]->autore}</a><br />
			{/if}
		{/foreach}
	{/if}
	
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}