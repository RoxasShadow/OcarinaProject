{*	/rendering/templates/default/index.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($lastlogout)}
		<div align="center">Ciao {$utente}, non ti connettevi a {$nomesito} dal {$lastlogout}, siamo felici di rivederti!</div>
	{/if}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else}
		{if is_array($news)}
			{foreach from=$news key=key item=item}
				{if $news[$key]->approvato == 1}
					<div class="titolo"><a href="{$url_index}/news.php?titolo={$news[$key]->minititolo}">{$news[$key]->titolo}</a></div>
					<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profilo.php?nickname={$news[$key]->autore}">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="{$url_index}/categoria.php?cat={$news[$key]->categoria}">{$news[$key]->categoria}</a>.</div><br />
					<div class="news">{$news[$key]->contenuto}</div>
					<div align="right"><a href="{$url_index}/news.php?titolo={$news[$key]->minititolo}">Lascia un commento {php}require_once('core/class.Comments.php'); $v = new Comments(); echo $v->countCommentByNews('{$news[$key]->minititolo}');{/php}</a></div>
					<hr />
				{/if}
			{/foreach}
			<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="{$url_index}/Aindex.php?p={$pagina}">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="{$url_index}/Aindex.php?p={$pagina}">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="{$url_index}/Aindex.php?p={$pagina}">{$pagina}</a></b>{else}<a href="{$url_index}/Aindex.php?p={$pagina}">{$pagina}</a> | {/if}{/foreach}</div>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
