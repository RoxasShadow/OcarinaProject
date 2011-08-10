{*	/rendering/templates/default/errorpage.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if ((isset($id)) && (isset($status)))}
		<div class="titolo">Errore {$id}: {$status}</div>
	{else}
		<div class="titolo">Errore indefinito.</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
