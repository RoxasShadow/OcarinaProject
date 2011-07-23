{*	/rendering/templates/admin/upload.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado <> 4))}
		Accesso negato.
	{elseif !$submit}
		<form action="" method="post" enctype="multipart/form-data">
		<input name="skin" type="file" size="40" /><br />
		<input name="upload" type="submit" value="Installa" />			
		</form>
	{else}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
