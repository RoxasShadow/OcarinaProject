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
					<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$pagina[$key]->autore}.html">{$pagina[$key]->autore}</a> il giorno {$pagina[$key]->data} alle ore {$pagina[$key]->ora} nella categoria <a href="{$url_index}/category/{$pagina[$key]->categoria}.html">{$pagina[$key]->categoria}</a>. {if $pagina[$key]->oraultimamodifica == $pagina[$key]->ora}Ultima modifica {if $pagina[$key]->dataultimamodifica == $pagina[$key]->data}oggi{else} il giorno {$pagina[$key]->dataultimamodifica}{/if} alle ore {$pagina[$key]->ora} {if $pagina[$key]->autoreultimamodifica !== $pagina[$key]->autore}da parte di {$pagina[$key]->autoreultimamodifica}.{/if}{/if}</div><br />
					<div class="news"><p>{$pagina[$key]->contenuto}</p></div><br />
					<a href="{$url_index}/vote.php?action=page&titolo={$pagina[$key]->minititolo}">Vota questa pagina</a>
					{if $pagina[$key]->voti == 1}
						(1 voto)
					{else}
						({$pagina[$key]->voti} voti)
					{/if}
				{else}
					La pagina non è stata approvata, e quindi non è visibile.
				{/if}
			{/foreach}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
