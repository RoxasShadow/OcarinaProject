{*	/rendering/templates/zen/errorpage.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if ((isset($id)) && (isset($status)))}
		<h2>Errore {$id}: {$status}</h2>
	{else}
		<h2>Errore indefinito.</h2>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
