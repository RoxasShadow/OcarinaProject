{*	/rendering/templates/admin/log.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado >= 6))}
		Accesso negato.
	{elseif isset($error)}
		{$error}
	{elseif !$submit}
		<table>
		<tr>
		<td><b>Nickname</b></td>
		<td><b>Azione</b></td>
		<td><b>IP</b></td>
		<td><b>Data e ora</b></td>
		<td><b>Useragent</b></td>
		<td><b>Referer</b></td>
		</tr>
		{foreach from=$log key=key item=item}
			<tr>
			{if $log[$key]->nickname == '~'}
				<td>~</td>
			{else}
				<td><a href="{$url_index}/profilo.php?nickname={$log[$key]->nickname}">{$log[$key]->nickname}</a></td>
			{/if}
			<td>{$log[$key]->azione}</td>
			<td><a href="http://www.db.ripe.net/whois?form_type=simple&full_query_string=&do_search=Search&searchtext={$log[$key]->ip}">{$log[$key]->ip}</a></td>
			<td>{$log[$key]->data} alle {$log[$key]->ora}</td>
			<td>{$log[$key]->useragent}</td>
			<td>{$log[$key]->referer}</td>
			</tr>
		{/foreach}
		</table>
		{if $grado == 1}
			<br /><br />
			<form action="" method="post">
			<input type="submit" name="submit" value="Pulisci i log" />
			</form>
		{/if}
		<div align="center">{foreach from=$navigatore item=pagina}{if $pagina == $currentPage && !$pagina@last}<b><a href="{$url_index}/admin/log/{$pagina}.html">{$pagina}</a></b> | {else if $pagina !== $currentPage && $pagina@last}<a href="{$url_index}/admin/log/{$pagina}.html">{$pagina}</a>{else if $pagina == $currentPage && $pagina@last}<b><a href="{$url_index}/admin/log/{$pagina}.html">{$pagina}</a></b>{else}<a href="{$url_index}/admin/log/{$pagina}.html">{$pagina}</a> | {/if}{/foreach}</div>
	{elseif $grado == 1 && $submit}
		{$result}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
