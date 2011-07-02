{*	/rendering/templates/default/pagina.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else}
		{if is_array($pagina)}
			{foreach from=$pagina key=key item=item}
				{if $pagina[$key]->approvato == 1}
					<div class="titolo">{$pagina[$key]->titolo}</div>
					<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profilo.php?nickname={$pagina[$key]->autore}">{$pagina[$key]->autore}</a> il giorno {$pagina[$key]->data} alle ore {$pagina[$key]->ora} nella categoria <a href="{$url_index}/categoria.php?cat={$pagina[$key]->categoria}">{$pagina[$key]->categoria}</a>.</div><br />
					<div class="news"><p>{$pagina[$key]->contenuto}</p></div>
				{else}
					La pagina non è stata approvata, e quindi non è visibile.
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
