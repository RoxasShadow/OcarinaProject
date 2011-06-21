{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<div id="titolo">{$result}</div>
	{elseif !$submit}
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Password attuale<br />
		<input type="password" name="oldPassword" /><br />
		</td>
		<td>
		Nuova password<br />
		<input type="password" name="password" /><br />
		</td>
		<td>
		Conferma nuova password<br />
		<input type="password" name="confPassword" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Modifica password" name="submit" />
		</td>
		</tr>
		</table>
		</form>
	{else}
		<div id="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
