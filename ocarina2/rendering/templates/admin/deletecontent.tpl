{*	/rendering/templates/admin/deletecontent.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 3))}
		Accesso negato.
	{elseif !$submit}
		{if ((!isset($content)) || ($content == ''))}
			{if (isset($whatis) && ($whatis == 'pagina'))}Nessuna pagina{elseif (isset($whatis) && ($whatis == 'news'))}Nessuna news{elseif (isset($whatis) && ($whatis == 'annuncio'))}Nessun annuncio{/if} presente da cancellare.
		{else}
			{if (isset($whatis) && ($whatis == 'pagina'))}Pagina{elseif (isset($whatis) && ($whatis == 'news'))}News{elseif (isset($whatis) && ($whatis == 'annuncio'))}Annuncio{/if} da cancellare<br />
			<form action="" method="post">
			<select name="content">
			{foreach from=$content key=key item=item}
				<option value="{$content[$key]->minititolo}">{$content[$key]->titolo}</option>
			{/foreach}
			</select>
			<input type="submit" name="submit" value="Cancella {if (isset($whatis) && ($whatis == 'pagina'))}pagina{elseif (isset($whatis) && ($whatis == 'pagina'))}news{/if}" />
			</form>
		{/if}
	{elseif $submit}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
