{*	/rendering/templates/admin/deletecontent.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 3))}
		Accesso negato.
	{elseif !$submit}
		<form action="" method="post">
		{if (isset($whatis) && ($whatis == 'pagina'))}Pagina{elseif (isset($whatis) && ($whatis == 'news'))}News{/if} da cancellare<br />
		<select name="content">
		{foreach from=$content key=key item=item}
			<option value="{$content[$key]->minititolo}">{$content[$key]->titolo}</option>
		{/foreach}
		</select>
		<input type="submit" name="submit" value="Cancella {if (isset($whatis) && ($whatis == 'pagina'))}pagina{elseif (isset($whatis) && ($whatis == 'pagina'))}news{/if}" />
		</form>
	{elseif $submit}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
