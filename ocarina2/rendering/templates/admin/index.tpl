{*	/rendering/templates/admin/index.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == ''}
		Accesso negato.
	{elseif (($grado < 4) && isset($immagini))}
		{if count($immagini) == 0}
			Nessuna immagine presente.
		{else}
			{for $var=0 to count($immagini)-1}
				<a href="{$url_immagini}/{$immagini[$var]}" target="_blank">{$immagini[$var]}</a> (<a href="{$url_admin}/immagini.php?delete={$immagini[$var]}">X</a>)<br />
			{/for}
		{/if}
	{elseif (($grado < 6) && !isset($immagini))}
		Ciao {$utente}, benvenuto nell'amministrazione.
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
