{*	/rendering/templates/admin/sitemap.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == ''}
		Accesso negato.
	{elseif (($grado < 3) || ($grado == 5))}
		{if isset($immagini)}
			{for $var=0 to count($immagini)-1}
				<a href="{$url_immagini}/{$immagini[$var]}" target="_blank">{$immagini[$var]}</a> (<a href="{$url_admin}/immagini.php?delete={$immagini[$var]}">X</a>)<br />
			{/for}
		{elseif !$submit}
			<form action="" method="post">
			<input type="submit" name="submit" value="Ricostruisci le sitemap" />
			</form>
		{else}
			Sitemap ricostruite.
		{/if}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
