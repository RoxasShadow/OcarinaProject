{*	/rendering/templates/default/recuperapassword.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $logged || isset($recupera)}
		<div class="titolo">{$result}</div>
	{elseif !$submit && !$recupero}
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Recupera password" name="submit" />
		</td>
		</tr>
		</table>
		</form>
	{else}
		<div class="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
