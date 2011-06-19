{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
	<div id="titolo">{$error}</div>
	{else}
	{if is_array($contenuto)}
	{foreach from=$contenuto key=key item=item}
	{if $contenuto[$key]->approvato == 1}
	<div id="titolo">{$contenuto[$key]->titolo}</div>
	<div id="newsheader" align="center">Scritto il giorno {$contenuto[$key]->data} alle ore {$contenuto[$key]->ora} nella categoria <a href="categoria.php?cat={$contenuto[$key]->categoria}">{$contenuto[$key]->categoria}</a>.</div><br />
	<div id="news">{$contenuto[$key]->contenuto}</div>
	{/if}
	{/foreach}
	{else}
	<div id="titolo">{$contenuto}</div>
	{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
