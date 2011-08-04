{*	/rendering/templates/admin/plugin.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 1))}
		Accesso negato.
	{elseif isset($plugins)}
		<table>
		<tr>
		<td><b>Nome</b></td>
		<td><b>Autore</b></td>
		<td><b>Descrizione</b></td>
		<td><b>Percorso</b></td>
		<td><b>Abilitato</b></td>
		</tr>
		{for $var=0 to count($plugins['name'])-1}
			<tr>
			<td>{$plugins['name'][$var]} {$plugins['version'][$var]}</td>
			<td><a href="http://{$plugins['website'][$var]}">{$plugins['author'][$var]}</a></td>
			<td>{$plugins['description'][$var]}</td>
			<td>{$plugins['path'][$var]}</td>
			{if $plugins['enabled'][$var] == 'true'}
				<td>Si</td>
			{elseif $plugins['enabled'][$var] == 'false'}
				<td>No</td>
			{/if}
		{/for}
		</table>
	{else}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
