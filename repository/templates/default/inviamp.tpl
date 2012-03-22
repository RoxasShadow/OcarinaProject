{*	/rendering/templates/default/inviamp.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<div class="titolo">{$result}</div>
	{elseif !$submit}
		<form action="" method="post">
		Destinatario<br />
		<select name="destinatario">
		{foreach from=$listautenti key=key item=item}
			<option value="{$listautenti[$key]->nickname}">{$listautenti[$key]->nickname}</option>
		{/foreach}
		</select><br />
		Oggetto<br />
		<input type="text" name="oggetto" /><br />
		Contenuto<br />
		<textarea name="contenuto" cols="22" rows="10"></textarea><br />
		{$captcha}<br />
		<input type="submit" value="Invia" name="submit" />
		</form>
	{else}
		<div class="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
