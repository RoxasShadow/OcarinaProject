{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == '' || !$logged}
		Accesso negato.
	{elseif $grado < 3 && !$submit}
		<form action="" method="post">
		News da cancellare<br />
		<select name="news">
		{foreach from=$news key=key item=item}
			<option value="{$news[$key]->minititolo}">{$news[$key]->titolo}</option>
		{/foreach}
		</select>
		<input type="submit" name="submit" value="Cancella news" />
		</form>
	{elseif $grado < 3 && $submit}
		{$result}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
