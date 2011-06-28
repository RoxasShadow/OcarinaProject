{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == '' || !$logged}
		Accesso negato.
	{elseif $grado < 4 && !$submit && !isset($result)}
		<form action="" method="post">
		Titolo<br />
		<input type="text" name="titolo" {if (isset($titolo_default))}value="{$titolo_default}"{/if} /><br /><br />
		Categoria<br />
		<select name="categoria">
		{foreach from=$categorie key=key item=item}
			 {if ((isset($categoria)) && ($categorie[$key] == $categoria))}
			 	<option value="{$categorie[$key]}" selected>{$categorie[$key]}</option>
			 {else}
				<option value="{$categorie[$key]}">{$categorie[$key]}</option>
			{/if}
		{/foreach}
		</select><br /><br />
		{if $bbcode == 1}
			{literal}
			<script type="text/javascript">
			function add(emoticons) {
			    var text = document.getElementById("txtQuota").value;
			    document.getElementById("txtQuota").value = text + emoticons;
			}
			function requestcolor() {
			    var colore = prompt("Digita il nome del colore (esempio: red, black, white)");
			    add('[color='+colore+'][/color]');
			}
			</script>
			{/literal}
			<a onclick="javascript:add('[b][/b]');"><b>Grassetto</b></a>
			<a onclick="javascript:add('[i][/i]');"><b>Corsivo</b></a>

			<a onclick="javascript:add('[u][/u]');"><b>Sottolineato</b></a>
			<a onclick="javascript:add('[s][/s]');"><b>Barrato</b></a>
			<a onclick="javascript:requestcolor();"><b>Colore</b></a>
			<a onclick="javascript:add('[url=http://][/url]');"><b>URL</b></a>
			<a onclick="javascript:add('[spoiler][/spoiler]');"><b>Spoiler</b></a>
			<a onclick="javascript:add('[left][/left]');"><b>Allineato a sinistra</b></a>
			<a onclick="javascript:add('[center][/center]');"><b>Allineato a centro</b></a>
			<a onclick="javascript:add('[right][/right]');"><b>Allineato a destra</b></a>
			<a onclick="javascript:add('[br]');"><b>Accapo</b></a>

			<a onclick="javascript:add('[code][/code]');"><b>Codice</b></a>
			<a onclick="javascript:add('[quote][/quote]');"><b>Citazione</b></a>
		{/if}
		<textarea name="testo" cols="59" rows="10" id="txtQuota">{if (isset($testo))}{$testo}{/if}</textarea><br />
		{if isset($sel)}<input type="hidden" name="selected" value="{$sel}" />{/if}
		<input type="submit" name="submit" {if (isset($whatis) && ($whatis !== ''))}value="{$whatis}"{/if} />
		</form>
	{elseif $grado < 4 && $submit && isset($result) || (!$submit && isset($result))}
		{$result}
	{elseif isset($result)}
		{$result}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}