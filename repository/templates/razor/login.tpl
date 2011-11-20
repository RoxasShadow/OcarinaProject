{*	/rendering/templates/razor/login.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged}
		<section><div class="notice">{$result}</div></section>
	{elseif !$submit}
		<section>
		<form method="post">
		<table border="0">
		<tr>
		<td>
		Nickname<br />
		<input type="text" name="nickname" /><br />
		</td>
		<td>
		Password<br />
		<input type="password" name="password" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Login" name="submit" />
		</td>
		</tr>
		</table>
		</form>
		</section>
	{else}
		<section><div class="notice">{$result}</div></section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
