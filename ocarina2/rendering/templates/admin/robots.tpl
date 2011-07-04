{*	/rendering/templates/admin/robots.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado < 3) || ($grado == 5))}
		{if !$submit}
			<a href="http://www.robotstxt.org/robotstxt.html" target="_blank">About the robots...</a><br />
			<form action="" method="post">
			<textarea name="robots" cols="59" rows="10">{if (isset($robots))}{$robots}{/if}</textarea><br />
			<input type="submit" name="submit" value="Salva" />
			</form>
		{else}
			Robots aggiornato.
		{/if}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
