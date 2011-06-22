{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<div id="titolo">{$result}</div>
	{elseif !$submit}
		<form action="" method="post">
		Email<br />
		<input type="text" name="email" value="{$email}" /><br /><br />
		Skin<br />
		<select name="skin">
		{foreach from=$listaskin key=key item=item}
			{if $listaskin[$key] == $skinattuale}
				<option value="{$listaskin[$key]}" selected>{$listaskin[$key]|capitalize}</option>
			{else}
				<option value="{$listaskin[$key]}">{$listaskin[$key]|capitalize}</option>
			{/if}
		{/foreach}
		</select><br /><br />
		Bio<br />
		<textarea name="bio" cols="22" rows="10">{$bio}</textarea><br /><br />
		Avatar<br />
		<input type="text" name="avatar" value="{$avatar}" /><br /><br />
		Password (per confermare le modifiche)<br />
		<input type="password" name="password" /><br /><br />
		<input type="submit" value="Modifica profilo" name="submit" />
		</form>
	{else}
		<div id="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
