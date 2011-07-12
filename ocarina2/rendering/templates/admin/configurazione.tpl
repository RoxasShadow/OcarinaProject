{*	/rendering/templates/admin/configuration.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 1))}
		Accesso negato.
	{elseif !$submit && !isset($result)}
		<form action="" method="post">
		Nome del sito<br />
		<input type="text" name="nomesito" maxlength="100" {if (isset($nomesito_default))}value="{$nomesito_default}"{/if} /><br /><br />
		Email<br />
		<input type="text" name="email" maxlength="100" {if (isset($email_default))}value="{$email_default}"{/if} /><br /><br />
		Attiva BBCode (0 = No, 1 = Si)<br />
		<input type="text" name="bbcode" maxlength="1" {if (isset($bbcode_default))}value="{$bbcode_default}"{/if} /><br /><br />
		Permetti registrazioni (0 = No, 1 = Si)<br />
		<input type="text" name="registrazioni" maxlength="1" {if (isset($registrazioni_default))}value="{$registrazioni_default}"{/if} /><br /><br />
		Validazione account con conferma email (0 = No, 1 = Si)<br />
		<input type="text" name="validazioneaccount" maxlength="1" {if (isset($validazioneaccount_default))}value="{$validazioneaccount_default}"{/if} /><br /><br />
		Abilita commenti (0 = No, 1 = Si)<br />
		<input type="text" name="commenti" maxlength="1" {if (isset($commenti_default))}value="{$commenti_default}"{/if} /><br /><br />
		Approva commenti automaticamente (0 = Si, 1 = No)<br />
		<input type="text" name="approvacommenti" maxlength="1" {if (isset($approvacommenti_default))}value="{$approvacommenti_default}"{/if} /><br /><br />
		Registra log automaticamente (0 = No, 1 = Si)<br />
		<input type="text" name="log" maxlength="1" {if (isset($log_default))}value="{$log_default}"{/if} /><br /><br />
		Nome del cookie<br />
		<input type="text" name="cookie" maxlength="20" {if (isset($cookie_default))}value="{$cookie_default}"{/if} /><br /><br />
		Skin di default<br />
		<select name="skin">
		{foreach from=$listaskin key=key item=item}
			{if ((isset($skin_default)) && ($skin_default !== '') && ($listaskin[$key] == $skin_default))}
				<option value="{$listaskin[$key]}" selected>{$listaskin[$key]|capitalize}</option>
			{else}
				<option value="{$listaskin[$key]}">{$listaskin[$key]|capitalize}</option>
			{/if}
		{/foreach}
		</select><br /><br />
		Breve descrizione del sito<br />
		<input type="text" name="description" maxlength="151" {if (isset($description_default))}value="{$description_default}"{/if} /><br /><br />
		Limite caratteri news<br />
		<input type="text" name="limitenews" maxlength="10" {if (isset($limitenews_default))}value="{$limitenews_default}"{/if} /><br /><br />
		News da mostrare per pagina<br />
		<input type="text" name="impaginazionenews" maxlength="10" {if (isset($impaginazionenews_default))}value="{$impaginazionenews_default}"{/if} /><br /><br />
		Minuti per i quali un utente è considerato online finchè non compie un'azione<br />
		<input type="text" name="limiteonline" maxlength="10" {if (isset($limiteonline_default))}value="{$limiteonline_default}"{/if} /><br /><br />
		Permetti i voti alle news<br />
		<input type="text" name="permettivoto" maxlength="10" {if (isset($permettivoto_default))}value="{$permettivoto_default}"{/if} /><br /><br />
		URL (ex.: http://www.tuosito.com)<br />
		<input type="text" name="url" maxlength="100" {if (isset($url_default))}value="{$url_default}"{/if} /><br /><br />
		URL index (ex.: http://www.tuosito.com/ocarina2)<br />
		<input type="text" name="url_index" maxlength="100" {if (isset($url_index_default))}value="{$url_index_default}"{/if} /><br /><br />
		URL admin (ex.: http://www.tuosito.com/ocarina2/admin)<br />
		<input type="text" name="url_admin" maxlength="100" {if (isset($url_admin_default))}value="{$url_admin_default}"{/if} /><br /><br />
		URL rendering (ex.: http://www.tuosito.com/ocarina2/rendering/)<br />
		<input type="text" name="url_rendering" maxlength="100" {if (isset($url_rendering_default))}value="{$url_rendering_default}"{/if} /><br /><br />
		URL immagini (ex.: http://www.tuosito.com/ocarina2/immagini)<br />
		<input type="text" name="url_immagini" maxlength="100" {if (isset($url_immagini_default))}value="{$url_immagini_default}"{/if} /><br /><br />
		Root (ex.: /var/www/htdocs)<br />
		<input type="text" name="root" maxlength="100" {if (isset($root_default))}value="{$root_default}"{/if} /><br /><br />
		Root index (ex.: /var/www/htdocs/ocarina2)<br />
		<input type="text" name="root_index" maxlength="100" {if (isset($root_index_default))}value="{$root_index_default}"{/if} /><br /><br />
		Root admin (ex.: /var/www/htdocs/ocarina2/admin)<br />
		<input type="text" name="root_admin" maxlength="100" {if (isset($root_admin_default))}value="{$root_admin_default}"{/if} /><br /><br />
		Root rendering (ex.: /var/www/htdocs/ocarina2/rendering)<br />
		<input type="text" name="root_rendering" maxlength="100" {if (isset($root_rendering_default))}value="{$root_rendering_default}"{/if} /><br /><br />
		Root immagini (ex.: /var/www/htdocs/ocarina2/immagini)<br />
		<input type="text" name="root_immagini" maxlength="100" {if (isset($root_immagini_default))}value="{$root_immagini_default}"{/if} /><br /><br />
		<input type="submit" name="submit" value="Salva" />
		</form>
	{elseif $submit && isset($result) || (!$submit && isset($result))}
		{$result}
	{elseif isset($result)}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
