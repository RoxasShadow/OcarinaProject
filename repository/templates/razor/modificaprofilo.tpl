{*	/rendering/templates/razor/modificaprofilo.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<section><div class="notice">{$result}</div></section>
	{elseif !$submit}
		<section class="center">
		<form method="post">
		Email<br />
		<input type="text" name="email" value="{$email}" /><br />
		Skin<br />
		<select name="skin">
		{foreach from=$listaskin key=key item=item}
			{if $listaskin[$key] == $skinattuale}
				<option value="{$listaskin[$key]}" selected>{$listaskin[$key]|capitalize}</option>
			{else}
				<option value="{$listaskin[$key]}">{$listaskin[$key]|capitalize}</option>
			{/if}
		{/foreach}
		</select><br />
		Bio<br />
		<textarea name="bio" cols="22" rows="10">{$bio}</textarea><br />
		Avatar<br />
		<input type="text" name="avatar" value="{$avatar}" /><br />
		Password (per confermare le modifiche)<br />
		<input type="password" name="password" /><br />
		<input type="submit" value="Modifica profilo" name="submit" />
		</form>
		</section>
	{else}
		<section><div class="notice">{$result}</div></section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
