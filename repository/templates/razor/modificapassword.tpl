{*	/rendering/templates/razor/modificapassword.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<section><div class="notice">{$result}</div></section>
	{elseif !$submit}
		<section class="center">
		<form method="post">
		Password attuale<br />
		<input type="password" name="oldPassword" /><br />
		Nuova password<br />
		<input type="password" name="password" /><br />
		Conferma nuova password<br />
		<input type="password" name="confPassword" /><br />
		<input type="submit" value="Modifica password" name="submit" />
		</form>
		</section>
	{else}
		<section><div class="notice">{$result}</div></section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
