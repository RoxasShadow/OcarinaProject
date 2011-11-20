{*	/rendering/templates/razor/index.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($lastlogout)}
		<div class="success">Ciao {$utente}, non ti connettevi a {$nomesito} dal {$lastlogout}, siamo felici di rivederti!</div>
	{/if}
	{if isset($error)}
		<section><div class="notice">{$error}</div></section>
	{else}
		{if is_array($news)}
			{foreach from=$news key=key item=item}
				<section>
				<header>
				<h2><a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a></h2>
				<h3>Scritto da <a href="{$url_index}/profile/{$news[$key]->autore}.html">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="{$url_index}/category/{$news[$key]->categoria}.html">{$news[$key]->categoria}</a>. {if $news[$key]->oraultimamodifica == $news[$key]->ora}Ultima modifica {if $news[$key]->dataultimamodifica == $news[$key]->data}oggi{else} il giorno {$news[$key]->dataultimamodifica}{/if} alle ore {$news[$key]->ora} {if $news[$key]->autoreultimamodifica !== $news[$key]->autore}da parte di {$news[$key]->autoreultimamodifica}.{/if}{/if}</h3>
				</header>
				<article>
				<p>{$news[$key]->contenuto}</p>
				</article>
				<footer>
				<div class="right"><a href="{$url_index}/news/{$news[$key]->minititolo}.html">Lascia un commento {php}require_once('core/class.Comments.php'); $v = new Comments(); echo $v->countCommentByNews('{$news[$key]->minititolo}');{/php}</a></div>
				</footer>
				</section>
				<hr />
			{/foreach}
			<div class="center" id="navigator">
			<p class='small'>{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="{$url_index}/p/{$pagina}.html">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="{$url_index}/p/{$pagina}.html">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="{$url_index}/p/{$pagina}.html">{$pagina}</a></b>{else}<a href="{$url_index}/p/{$pagina}.html">{$pagina}</a> | {/if}{/foreach}</p>
			</div>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
