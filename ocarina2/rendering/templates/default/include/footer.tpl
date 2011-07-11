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
<p><font color="white">Pagina generata in {$time} secondi effettuando {$query} query.<br />
{if ((isset($useronline)) && (!empty($useronline)))}
	Utenti online: 
	{foreach $useronline as $user}
		{if $user@last}
			{$user}
		{else}
			{$user}, 
		{/if}
	{/foreach}
{else}
	Nessun utente online.
{/if}
<br />
{if ((isset($visitatoronline)) && (is_numeric($visitatoronline)) && ($visitatoronline > 0))}
	Visitatori online: {$visitatoronline}
{else}
	Nessun visitatore online.
{/if}
</font></p>
<a href="http://validator.w3.org/check?uri=referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-xhtml10-blue.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/vcss-blue.png" alt="CSS Valido!" height="31" width="88" /></a>
<a href="http://feed2.w3.org/check.cgi?url={$url_index}/feed.php"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-rss-blue.gif" alt="[Valid RSS]" height="31" width="88" /></a>
</div>
</body>
</html>
