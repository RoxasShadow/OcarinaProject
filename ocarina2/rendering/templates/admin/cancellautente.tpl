{*	/rendering/templates/admin/cancellautente.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 1))}
		Accesso negato.
	{elseif !$submit}
		<form action="" method="post">
		Utente<br />
		<select name="nickname">
		{foreach from=$utenti key=key item=item}
			<option value="{$utenti[$key]->nickname}">{$utenti[$key]->nickname}</option>
		{/foreach}
		</select>
		Rimuovi anche tutti i suoi contenuti <input type="checkbox" name="all" />
		<br />
		<input type="submit" name="submit" value="Cancella" />
		</form>
	{elseif $submit}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
