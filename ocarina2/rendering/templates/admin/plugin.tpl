{*	/rendering/templates/admin/plugin.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 1))}
		Accesso negato.
	{elseif isset($result)}
		{$result}
	{elseif isset($plugins)}
		<form action="" method="post" enctype="multipart/form-data">
		<input name="plugin" type="file" size="40" /><br />
		<input name="upload" type="submit" value="Upload" />				
		</form>
		<br />
		{if isset($plugins['name'])}
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
				<td>{$plugins['name'][$var]} {$plugins['version'][$var]} (<a href="?disinstall={$plugins['name'][$var]}">Disinstalla</a>)</td>
				<td><a href="http://{$plugins['website'][$var]}">{$plugins['author'][$var]}</a></td>
				<td>{$plugins['description'][$var]}</td>
				<td>{$plugins['path'][$var]}</td>
				{if $plugins['enabled'][$var] == 'true'}
					<td><a href="?deactive={$plugins['name'][$var]}">Si</a></td>
				{elseif $plugins['enabled'][$var] == 'false'}
					<td><a href="?active={$plugins['name'][$var]}">No</a></td>
				{/if}
			{/for}
			</table>
		{else}
			Nessun plugin attualmente installato.
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
