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
			<div id="titolo">{$result[$key]->nickname}</div>
			<img src="{$result[$key]->avatar}" />
			<br /><br />
			
			<table border="0" cellpadding="2">
			<tr>
			<td><b>Email</b></td>
			<td><b>Data registrazione</b></td>
			<td><b>Bio</b></td>
			<td><b>Browser</b></td>
			<td><b>Piattaforma</b></td>
			</tr>
			<tr>
			<td>{mailto address={$result[$key]->email} encode='javascript_charcode'}</td>
			<td>{$result[$key]->data}</td>
			<td>{$result[$key]->bio}</td>
			<td>{$result[$key]->browsername}<br />{$result[$key]->browserversion}</td>
			<td>{$result[$key]->platform}</td>
			</tr>
			</table>
			</div>
		{/foreach}
	{else}
		<div id="titolo">{$result}</div>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
