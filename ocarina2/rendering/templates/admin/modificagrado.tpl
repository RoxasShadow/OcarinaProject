{*	/rendering/templates/admin/modificagrado.tpl
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
		<br /><br />
		Grado<br />
		<select name="grado">
		<option value="1">Amministratore</option>
		<option value="2">Moderatore</option>
		<option value="3">Editore</option>
		<option value="4">Grafico</option>
		<option value="5">SEO</option>
		<option value="6">Utente</option>
		<option value="7">Bannato</option>
		</select>
		<input type="submit" name="submit" value="Modifica" />
		</form>
	{elseif $submit}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
