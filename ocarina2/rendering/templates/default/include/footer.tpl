{*	/rendering/templates/default/footer.tpl
	(C) Giovanni Capuano 2011
*}
</td>
</tr>
</table>
</td>
</tr>
</table>
<div align="center">
{$stats}
<p><font color="white">Pagina generata in {$time} secondi, con {$numQuery} query e {$numCache} accessi alla cache.<br />
{if ((isset($useronline)) && (!empty($useronline)))}
	Utenti online: 
	{foreach $useronline as $user}
		{if $user@last}
			<a href="{$url_index}/profile/{$user}.html">{$user}</a>
		{else}
			<a href="{$url_index}/profile/{$user}.html">{$user}</a>, 
		{/if}
	{/foreach}
{else}
	Nessun utente online.
{/if}
{if ((isset($visitatoronline)) && (is_numeric($visitatoronline)) && ($visitatoronline > 0))}
	<br />Visitatori online: {$visitatoronline}
{else}
	<br />Nessun visitatore online.
{/if}
{if ((isset($totaleaccessi)) && (is_numeric($totaleaccessi)))}
	<br />Totale accessi: {$totaleaccessi}
{/if}
</font></p>
<a href="http://validator.w3.org/check?uri=referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-xhtml10-blue.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/vcss-blue.png" alt="CSS Valido!" height="31" width="88" /></a>
<a href="http://feed2.w3.org/check.cgi?url={$url_index}/feed.php"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-rss-blue.gif" alt="[Valid RSS]" height="31" width="88" /></a>
</div>
{$footer}
</body>
</html>
