{*	/rendering/templates/default/news.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<div class="titolo">{$error}</div>
	{else if isset($commentSended)}
		<div class="titolo">{$commentSended}</div>
	{elseif is_array($news)}
		<div class="titolo">{$news[0]->titolo}</div>
		<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$news[0]->autore}.html">{$news[0]->autore}</a> il giorno {$news[0]->data} alle ore {$news[0]->ora} nella categoria <a href="{$url_index}/category/{$news[0]->categoria}.html">{$news[0]->categoria}</a>. {if $news[0]->oraultimamodifica == $news[0]->ora}Ultima modifica {if $news[0]->dataultimamodifica == $news[0]->data}oggi{else} il giorno {$news[0]->dataultimamodifica}{/if} alle ore {$news[0]->ora} {if $news[0]->autoreultimamodifica !== $news[0]->autore}da parte di {$news[0]->autoreultimamodifica}.{/if}{/if}</div><br />
		<div class="news"><p>{$news[0]->contenuto}</p></div><br />
		<div id="voteresponse"></div>
		{if $utente !== ''}
			<a href="#" onclick="sendGet('{$url_index}/api.php?action=votenews&title={$news[0]->minititolo}', 'voteresponse', undefined, 'true', Array(9, 'Votato.'), 'Hai già votato questa news.'); setTimeout('sendGet(\'{$url_index}/api.php?action=news&title={$news[0]->minititolo}\', \'voto\', undefined, \'true\', undefined, undefined, \'votes\');', 200);">Vota questa news</a>
			{if $news[0]->voti == 1}
				(<a id="voto" class="no-prop">1</a> voto)
			{else}
				(<a id="voto" class="no-prop">{$news[0]->voti}</a> voti)
				{/if}
		{else}
			<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per votare questa news.
		{/if}
		{if !is_array($commenti)}
			<br /><hr /><br />
			<div class="news">{$commenti}</div>
		{else}
			<br /><hr /><br />
			{foreach from=$commenti key=key item=item}
				<fieldset><legend><a href="{$url_index}/comment/{$commenti[$key]->id}.html">#{$item@iteration}</a> Commento inviato il giorno {$commenti[$key]->data} alle ore {$commenti[$key]->ora} da <a href="{$url_index}/profile/{$commenti[$key]->autore}.html">{$commenti[$key]->autore}</a>. {if ((isset($grado)) && (is_numeric($grado)) && ($grado < 3))}<a href="{$url_index}/admin/cancellacommento.php?id={$commenti[$key]->id}">(X)</a>{/if} <a onclick="quota('{$item@iteration}');">Quota</a></legend><div id="{$item@iteration}">{$commenti[$key]->contenuto}</div></fieldset><br />
			{/foreach}
		{/if}
		<br />
		{if !$logged}
			<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per commentare questa news.
		{else}
			{if $bbcode == 1}
				<a onclick="request('b');"><b>Grassetto</b></a>
				<a onclick="request('i');"><b>Corsivo</b></a>
				<a onclick="request('u');"><b>Sottolineato</b></a>
				<a onclick="request('s');"><b>Barrato</b></a>
				<a onclick="requestcolor();"><b>Colore</b></a>
				<a onclick="requesturl();"><b>URL</b></a>
				<a onclick="request('spoiler');"><b>Spoiler</b></a>
				<a onclick="request('left');"><b>Allineato a sinistra</b></a>
				<a onclick="request('center');"><b>Allineato a centro</b></a>
				<a onclick="request('right');"><b>Allineato a destra</b></a>
				<a onclick="request('code');"><b>Codice</b></a>
				<a onclick="request('quote');"><b>Citazione</b></a>
				<a onclick="requestuser();"><b>Utente</b></a>
				<a onclick="requesttranslate();"><b>Traduci</b></a><br />
			{/if}
			<form action="" method="post">
			<textarea name="comment" cols="59" rows="10" id="targetForm"></textarea><br />
			<input type="submit" value="Invia commento" /><input type="button" onclick="return sendSinglePost('{$url_admin}/preview.php?type=comment', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
			<div id="previewBox"></div>
			</form>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
