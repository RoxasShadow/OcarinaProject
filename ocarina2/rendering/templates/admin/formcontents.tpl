{*	/rendering/templates/admin/formcontents.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 3))}
		Accesso negato.
	{elseif !$submit && !isset($result)}
		<form action="" method="post">
		Titolo<br />
		<input type="text" name="titolo" {if (isset($titolo_default))}value="{$titolo_default}"{/if} /><br /><br />
		{if ((!isset($nocategory)) || ($nocategory !== 1))}
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
		{/if}
		{if $bbcode == 1}
			<a onclick="request('b');"><b>Grassetto</b></a>
			<a onclick="request('i');"><b>Corsivo</b></a>
			<a onclick="request('u');"><b>Sottolineato</b></a>
			<a onclick="request('s');"><b>Barrato</b></a>
			<a onclick="requestcolor();"><b>Colore</b></a>
			<a onclick="requesturl();"><b>URL</b></a>
			<a onclick="request('spoiler');"><b>Spoiler</b></a>
			<a onclick="requestimg();"><b>Immagine</b></a>
			<a onclick="requestimgdim();"><b>Immagine con dimensioni</b></a>
			<a onclick="request('summary');"><b>Paragrafo</b></a>
			<a onclick="request('left');"><b>Allineato a sinistra</b></a>
			<a onclick="request('center');"><b>Allineato a centro</b></a>
			<a onclick="request('right');"><b>Allineato a destra</b></a>
			<a onclick="request('code');"><b>Codice</b></a>
			<a onclick="request('quote');"><b>Citazione</b></a>
			<a onclick="requestuser();"><b>Utente</b></a>
			<a onclick="requestyoutube();"><b>Youtube</b></a><br />
		{else}
			Tag HTML permessi.<br />
		{/if}
		<textarea name="testo" cols="59" rows="10" id="targetForm">{if (isset($testo))}{$testo}{/if}</textarea><br />
		{if isset($sel)}<input type="hidden" name="selected" value="{$sel}" />{/if}
		<input type="submit" name="submit" value="Conferma" /><input type="button" onclick="return sendSinglePost('{$url_admin}/preview.php', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
		<div id="previewBox"></div>
		</form>
	{elseif $submit && isset($result) || (!$submit && isset($result))}
		{$result}
	{elseif isset($result)}
		{$result}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
