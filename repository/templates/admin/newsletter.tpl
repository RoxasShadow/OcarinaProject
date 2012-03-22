{*	/rendering/templates/admin/robots.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if ($grado == 1)}
		{if !$submit}
			<form action="" method="post">
			Oggetto<br />
			<input type="text" name="oggetto" /><br />
			Testo<br />
			<textarea name="testo" cols="59" rows="10"></textarea><br />
			<input type="submit" name="submit" value="Invia" />
			</form>
		{else}
			{$result}
		{/if}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
