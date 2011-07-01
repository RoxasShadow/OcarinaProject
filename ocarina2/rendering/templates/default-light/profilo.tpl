{*	/rendering/templates/default/profilo.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($listautenti)}
		<div align="center">
		<form action="" method="post">
		<select name="nickname">
			{foreach from=$listautenti key=key item=item}
				<option value="{$listautenti[$key]->nickname}">{$listautenti[$key]->nickname}</option>
			{/foreach}
		</select>
		<input type="submit" value="Visita profilo" />
		</form>
		</div>
	{elseif is_array($result)}
		{foreach from=$result key=key item=item}
			<div align="center">
			<div class="titolo">{$result[$key]->nickname}</div>
			{if $result[$key]->avatar !== ''}<img src="{$result[$key]->avatar}" /><br />{/if}
			<br />
			
			<table border="0" cellpadding="2">
			<tr>
			<td><b>Email</b></td>
			<td><b>Data registrazione</b></td>
			<td><b>Grado</b></td>
			<td><b>Bio</b></td>
			<td><b>Browser</b></td>
			<td><b>Piattaforma</b></td>
			</tr>
			<tr>
			<td>{mailto address={$result[$key]->email} encode='javascript_charcode'}</td>
			<td>{$result[$key]->data}</td>
			<td>{if $result[$key]->grado == 1}Amministratore{elseif $result[$key]->grado == 2}Moderatore{elseif $result[$key]->grado == 3}Editore{elseif $result[$key]->grado == 4}Grafico{elseif $result[$key]->grado == 5}SEO{elseif $result[$key]->grado == 6}Utente{elseif $result[$key]->grado == 7}Bannato{/if}</td>
			<td>{$result[$key]->bio}</td>
			<td>{$result[$key]->browsername}<br />{$result[$key]->browserversion}</td>
			<td>{$result[$key]->platform}</td>
			</tr>
			</table>
			</div>
		{/foreach}
	{else}
		<div class="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
