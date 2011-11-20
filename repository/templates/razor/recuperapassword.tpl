{*	/rendering/templates/razor/recuperapassword.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged || isset($recupera)}
		<section><div class="notice">{$result}</div></section>
	{elseif !$submit && !isset($recupero)}
		<section>
		<form method="post">
		<table border="0">
		<tr>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		</table>
		<br />
		{$captcha}
		<br />
		<input type="submit" value="Recupera password" name="submit" />
		</form>
		</section>
	{else}
		<section><div class="notice">{$result}</div></section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
