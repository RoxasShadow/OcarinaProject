{*	/rendering/templates/zen/registrazione.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	<div id="post-0" class="post">
	{if $logged}
		<h2>{$result}</h2>
	{elseif ((isset($codiceRegistrazione)) && ($codiceRegistrazione !== ''))}
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
		Conferma password<br />
		<input type="password" name="confPassword" /><br />
		</td>
		<td>
		Email<br />
		<input type="email" name="email" /><br />
		</td>
		</table>
		<br />
		{$captcha}
		<br />
		<input type="submit" value="Registrati" name="submit" />
		</form>
	{else}
		<h2>{$result}</h2>
	{/if}
	</div>
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
