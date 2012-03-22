{*	/rendering/templates/zen/modificaprofilo.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<h2>{$result}</h2>
	{elseif !$submit}
		<form action="" method="post">
		Email<br />
		<input type="email" name="email" value="{$email}" /><br /><br />
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
		<input type="url" name="avatar" value="{$avatar}" /><br /><br />
		Password (per confermare le modifiche)<br />
		<input type="password" name="password" /><br /><br />
		<input type="submit" value="Modifica profilo" name="submit" />
		</form>
	{else}
		<h2>{$result}</h2>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
