{*	/rendering/templates/razor/ricerca.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $cerca}
		<section class="center">
		Cerca tra le news:<br />
		<form method="get">
		<input type="text" name="news" /><input type="submit" value="Cerca" />
		</form>
		<br />
		Cerca tra le pagine:<br />
		<form method="get">
		<input type="text" name="pagine" /><input type="submit" value="Cerca" />
		</form>
		<br />
		Cerca tra i commenti:<br />
		<form method="get">
		<input type="text" name="commenti" /><input type="submit" value="Cerca" />
		</form>
		</section>
	{else}
	
	{if isset($error_news)}
		<section><div class="notice">{$error_news}</div></section>
	{else if isset($news)}
		<section>
		<h5>News</h5>
		<ul>
		{foreach from=$news key=key item=item}
			<li><a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a></li>
		{/foreach}
		</ul>
		</section>
	{/if}
	
	{if isset($error_page)}
		<section><div class="notice">{$error_page}</div></section>
	{else if isset($pagina)}
		<section>
		<h5>Pagine</h5>
		<ul>
		{foreach from=$pagina key=key item=item}
			<li><a href="{$url_index}/page/{$pagina[$key]->minititolo}.html">{$pagina[$key]->titolo}</a></li>
		{/foreach}
		</ul>
		</section>
	{/if}
	
	{if isset($error_comment)}
		<h2 class="title">{$error_comment}</h2>
	{else if isset($commento)}
		<section>
		<h5>Commenti</h5>
		<ul>
		{foreach from=$commento key=key item=item}
			<li><a href="{$url_index}/comment/{$commento[$key]->id}.html">#{$commento[$key]->id} - {$commento[$key]->autore}</a></li>
		{/foreach}
		</ul>
		</section>
	{/if}
	
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
