{*	rendering/templates/admin/footer.tpl
	(C) Giovanni Capuano 2011
*}
<br /><br />
</div>
<div class="clear"></div>
</div>
</div>
</div> <!-- /wrapper -->
<div align="center">
{$stats}
<p>Pagina generata in {$time} secondi, con {$numQuery} query e {$numCache} accessi alla cache.</p>
<a href="http://validator.w3.org/check?uri=referer"><img src="{$url_rendering}/templates/{$skin}/resources/img/valid-xhtml10-blue.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="{$url_rendering}/templates/{$skin}/resources/img/vcss-blue.png" alt="CSS Valido!" height="31" width="88" /></a>
</div>
{$footer}
</body>
</html>
