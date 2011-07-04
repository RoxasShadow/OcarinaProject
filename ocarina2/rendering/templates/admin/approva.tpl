{*	/rendering/templates/admin/approva.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 2))}
	{elseif !$submit}
		<form action="" method="post">
		<table>
		<tr>
		<td><b>News</b></td>
		<td><b>Commenti</b></td>
		<td><b>Pagine</b></td>
		<td></td>
		</tr>
		<tr>
		<td>
		<select name="news">
		<option value="">------</option>
		{if ((isset($news)) && (!empty($news)))}
			{foreach from=$news key=key item=item}
				<option value="{$news[$key]->minititolo}">{$news[$key]->titolo}</option>
			{/foreach}
		{/if}
		</select>
		</td>
		<td>
		<select name="commento">
		<option value="">------</option>
		{if ((isset($commenti)) && (!empty($commenti)))}
			{foreach from=$commenti key=key item=item}
				<option value="{$commenti[$key]->id}">#{$commenti[$key]->id}</option>
			{/foreach}
		{/if}
		</select>
		</td>
		<td>
		<select name="pagina">
		<option value="">------</option>
		{if ((isset($pagine)) && (!empty($pagine)))}
			{foreach from=$pagine key=key item=item}
				<option value="{$pagine[$key]->minititolo}">{$pagine[$key]->titolo}</option>
			{/foreach}
		{/if}
		</select>
		</td>
		<td><input type="submit" name="submit" value="Approva selezionato" /></td>
		</tr>
		</table>
		</form>
	{elseif $submit}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
