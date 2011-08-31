{*	/rendering/templates/admin/formcontents.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 3))}
		Accesso negato.
	{elseif !$submit && !isset($result)}
		<form action="" method="post">
		Titolo<br />
		<input type="text" name="titolo" {if (isset($titolo_default))}value="{$titolo_default}"{/if} /><br /><br />
		{if ((!isset($nocategory)) || ($nocategory !== 1))}
			Categoria<br />
			<select name="categoria">
			{foreach from=$categorie key=key item=item}
				 {if ((isset($categoria)) && ($categorie[$key] == $categoria))}
				 	<option value="{$categorie[$key]}" selected>{$categorie[$key]}</option>
				 {else}
					<option value="{$categorie[$key]}">{$categorie[$key]}</option>
				{/if}
			{/foreach}
			</select><br /><br />
		{/if}
		{include file="$root_rendering/templates/$skin/include/editor.tpl"}
		{if $bbcode == 1}
			{include file="$root_rendering/templates/$skin/include/bbcode.tpl"}
		{else}
			Tag HTML permessi.<br />
		{/if}
		<textarea name="testo" cols="59" rows="10" id="targetForm">{if (isset($testo))}{$testo}{/if}</textarea><br />
		{if isset($sel)}<input type="hidden" name="selected" value="{$sel}" />{/if}
		<input type="submit" name="submit" value="Conferma" /><input type="button" onclick="return sendSinglePost('{$url_admin}/preview.php', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
		<div id="previewBox"></div>
		</form>
	{elseif $submit && isset($result) || (!$submit && isset($result))}
		{$result}
	{elseif isset($result)}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
