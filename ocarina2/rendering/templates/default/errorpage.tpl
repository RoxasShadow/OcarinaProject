{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($id)}
		<div class="titolo">Errore {$id}</div>
	{else}
		<div class="titolo">Errore indefinito</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
