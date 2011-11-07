{*	/rendering/templates/zen/login.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged}
		<h2>{$result}</h2>
	{elseif !$submit}
		<form action="" method="post">
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
	{else}
		<h2>{$result}</h2>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
