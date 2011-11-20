{*	/rendering/templates/razor/errorpage.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if ((isset($id)) && (isset($status)))}
		<section><div class="notice">Errore {$id}: {$status}</div></section>
	{else}
		<section><div class="notice">Errore indefinito.</div></section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
