{*	/rendering/templates/default/registrazione.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged}
		<div class="titolo">{$result}</div>
	{elseif ((isset($codiceRegistrazione)) && ($codiceRegistrazione !== ''))}
		<div class="titolo">{$result}</div>
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
		Conferma password<br />
		<input type="password" name="confPassword" /><br />
		</td>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		</table>
		<br />
		{$captcha}
		<br />
		<input type="submit" value="Registrati" name="submit" />
		</form>
	{else}
		<div class="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}