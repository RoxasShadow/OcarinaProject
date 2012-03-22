{*	/rendering/templates/admin/annunci.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado >= 6))}
		Accesso negato.
	{elseif is_array($ads)}
		{foreach from=$ads key=key item=item}
			<fieldset><legend>{$ads[$key]->titolo} - Scritto da <a href="{$url_index}/profile/{$ads[$key]->autore}.html">{$ads[$key]->autore}</a> il giorno {$ads[$key]->data} alle ore {$ads[$key]->ora}.</legend>{$ads[$key]->contenuto}</fieldset>
			<br /><br />
		{/foreach}
	{else}
		Nessun annuncio presente.
	{/if}
