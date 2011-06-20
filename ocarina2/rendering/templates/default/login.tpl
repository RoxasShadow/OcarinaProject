{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged}
		<div id="titolo">{$result}</div>
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
		<div id="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
