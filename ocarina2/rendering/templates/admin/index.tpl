{*	/rendering/templates/admin/index.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == ''}
		Accesso negato.
	{elseif $grado < 6}
		Ciao {$utente}, benvenuto nell'amministrazione.
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
