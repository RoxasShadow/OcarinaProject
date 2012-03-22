{*	/rendering/templates/zen/recuperapassword.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	<div id="post-0" class="post">
	{if $logged || isset($recupera)}
		<h2>{$result}</h2>
	{elseif !$submit && !isset($recupero)}
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Email<br />
		<input type="email" name="email" /><br />
		</td>
		</table>
		<br />
		{$captcha}
		<br />
		<input type="submit" value="Recupera password" name="submit" />
		</form>
	{else}
		<h2>{$result}</h2>
	{/if}
	</div>
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
