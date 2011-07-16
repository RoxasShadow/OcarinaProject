{*	/rendering/templates/default/news.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else if isset($commentSended)}
		<div class="titolo">{$commentSended}</div>
	{elseif is_array($news)}
		{foreach from=$news key=key item=item}
			{if $news[$key]->approvato == 1}
				<div class="titolo">{$news[$key]->titolo}</div>
				<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$news[$key]->autore}.html">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="{$url_index}/category/{$news[$key]->categoria}.html">{$news[$key]->categoria}</a>. {if $news[$key]->oraultimamodifica == $news[$key]->ora}Ultima modifica {if $news[$key]->dataultimamodifica == $news[$key]->data}oggi{else} il giorno {$news[$key]->dataultimamodifica}{/if} alle ore {$news[$key]->ora} {if $news[$key]->autoreultimamodifica !== $news[$key]->autore}da parte di {$news[$key]->autoreultimamodifica}.{/if}{/if}</div><br />
				<div class="news"><p>{$news[$key]->contenuto}</p></div><br />
				{if $utente !== ''}
					<a href="{$url_index}/vote.php?action=news&titolo={$news[$key]->minititolo}">Vota questa news</a>
					{if $news[$key]->voti == 1}
						(1 voto)
					{else}
						({$news[$key]->voti} voti)
					{/if}
				{else}
					<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per votare questa news.
				{/if}
			{else}
				La news non è stata approvata, e quindi non è visibile.
			{/if}
		{/foreach}
		{if !is_array($commenti)}
			<br /><hr /><br />
			<div class="news">{$commenti}</div>
		{else}
			<br /><hr /><br />
			{foreach from=$commenti key=key item=item}
				{if $commenti[$key]->approvato == 1}
					<fieldset><legend><a href="{$url_index}/comment/{$commenti[$key]->id}.html">#{$item@iteration}</a> Commento inviato il giorno {$commenti[$key]->data} alle ore {$commenti[$key]->ora} da <a href="{$url_index}/profile/{$commenti[$key]->autore}.html">{$commenti[$key]->autore}</a>. {if ((isset($grado)) && (is_numeric($grado)) && ($grado < 3))}<a href="{$url_index}/admin/cancellacommento.php?id={$commenti[$key]->id}">(X)</a>{/if} <a onclick="quota('{$item@iteration}');">Quota</a></legend><div id="{$item@iteration}">{$commenti[$key]->contenuto}</div></fieldset><br />
				{/if}
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
				<a onclick="requestuser();"><b>Utente</b></a><br />
			{/if}
			<form action="" method="post">
			<textarea name="comment" cols="59" rows="10" id="targetForm"></textarea><br />
			<input type="submit" value="Invia commento" /><input type="button" onclick="return sendSinglePost('{$url_admin}/preview.php?type=comment', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
			<div id="previewBox"></div>
			</form>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
