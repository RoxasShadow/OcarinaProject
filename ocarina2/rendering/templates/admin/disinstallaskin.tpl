{*	/rendering/templates/admin/upload.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado <> 4))}
		Accesso negato.
	{elseif !$submit}
		<form action="" method="post" enctype="multipart/form-data">
		<select name="nomeskin">
			{foreach from=$listaskin key=key item=item}
				<option value="{$listaskin[$key]}">{$listaskin[$key]|capitalize}</option>
			{/foreach}
		</select>
		<input name="submit" type="submit" value="Disinstalla" />				
		</form>
	{else}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
