{*	/rendering/templates/default/index.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($lastlogout)}
		<div align="center">Ciao {$utente}, non ti connettevi a {$nomesito} dal {$lastlogout}, siamo felici di rivederti!</div>
	{/if}
	{if isset($error)}
		<div class="titolo">{$error}</div>
	{else}
		{if is_array($news)}
			{foreach from=$news key=key item=item}
				{if $news[$key]->approvato == 1}
					<div class="titolo"><a href="{$url_index}/news/{$news[$key]->minititolo}.html">{$news[$key]->titolo}</a></div>
					<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$news[$key]->autore}.html">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="{$url_index}/category/{$news[$key]->categoria}.html">{$news[$key]->categoria}</a>. {if $news[$key]->oraultimamodifica == $news[$key]->ora}Ultima modifica {if $news[$key]->dataultimamodifica == $news[$key]->data}oggi{else} il giorno {$news[$key]->dataultimamodifica}{/if} alle ore {$news[$key]->ora} {if $news[$key]->autoreultimamodifica !== $news[$key]->autore}da parte di {$news[$key]->autoreultimamodifica}.{/if}{/if}</div><br />
					<div class="news"><p>{$news[$key]->contenuto}</p></div>
					<div align="right"><a href="{$url_index}/news/{$news[$key]->minititolo}.html">Lascia un commento {php}require_once('core/class.Comments.php'); $v = new Comments(); echo $v->countCommentByNews('{$news[$key]->minititolo}');{/php}</a></div>
					<hr />
				{/if}
			{/foreach}
			<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="{$url_index}/p/{$pagina}.html">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="{$url_index}/p/{$pagina}.html">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="{$url_index}/p/{$pagina}.html">{$pagina}</a></b>{else}<a href="{$url_index}/p/{$pagina}.html">{$pagina}</a> | {/if}{/foreach}</div>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
