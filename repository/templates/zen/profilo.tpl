{*	/rendering/templates/zen/profilo.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	<div id="post-0" class="post">
	{if isset($listautenti)}
		<form action="" method="post">
		<select name="nickname">
			{foreach from=$listautenti key=key item=item}
				<option value="{$listautenti[$key]->nickname}">{$listautenti[$key]->nickname}</option>
			{/foreach}
		</select>
		<input type="submit" value="Visita profilo" />
		</form>
	{elseif is_array($result)}
		<h2>{$result[0]->nickname}</h2>
		{if $result[0]->avatar !== ''}<img src="{$result[0]->avatar}" /><br />{/if}
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
		<td>{mailto address={$result[0]->email} encode='javascript_charcode'}</td>
		<td>{$result[0]->data}</td>
		<td>{if $result[0]->grado == 1}Amministratore{elseif $result[0]->grado == 2}Moderatore{elseif $result[0]->grado == 3}Editore{elseif $result[0]->grado == 4}Grafico{elseif $result[0]->grado == 5}SEO{elseif $result[0]->grado == 6}Utente{elseif $result[0]->grado == 7}Bannato{/if}</td>
		<td>{$result[0]->bio}</td>
		<td>{$result[0]->browsername}<br />{$result[0]->browserversion}</td>
		<td>{$result[0]->platform}</td>
		</tr>
		</table>
	{else}
		<h2>{$result}</h2>
	{/if}
	</div>
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
