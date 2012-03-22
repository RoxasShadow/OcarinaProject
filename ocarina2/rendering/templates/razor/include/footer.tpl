{*	/rendering/templates/razor/footer.tpl
	(C) Giovanni Capuano 2011
*}
</div>
<footer>
<div class="right" id="footer">
<p class="small">
{$stats}
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
	Utenti online: 0
{/if}
{if ((isset($visitatoronline)) && (is_numeric($visitatoronline)) && ($visitatoronline > 0))}
	<br />Visitatori online: {$visitatoronline}
{else}
	<br />Nessun visitatore online.
{/if}
{if ((isset($totaleaccessi)) && (is_numeric($totaleaccessi)))}
	<br />Totale accessi: {$totaleaccessi}
{/if}
<br />News: {$countnews}, Pagine: {$countpages}, Utenti: {$countusers} (<a href="{$url_index}/profile/{$lastuser}.html">{$lastuser}</a>)</p>
{$footer}

<!-- START VALIDATORS (you can remove this) -->
<div class="center">
<a href="http://validator.w3.org/check?uri=referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-html5-blue.png" alt="Valid HTML5" height="31" width="88" /></a>
<a href="http://validator.w3.org/check?uri=referer"><img src="{$url_rendering}/templates/{$skin}/resources/images/vcss-blue.png" alt="Valid CSS" height="31" width="88" /></a>
<a href="http://feed2.w3.org/check.cgi?url={$url_index}/feed.php"><img src="{$url_rendering}/templates/{$skin}/resources/images/valid-rss-blue.png" alt="Valid RSS" height="31" width="88" /></a>
</div>
<!-- END -->

</div>
</footer>
</div>
</body>
</html>
