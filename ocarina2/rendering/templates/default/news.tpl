{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($commentSended)}
	<div id="titolo">{$commentSended}</div>
	{else if isset($error)}
	<div id="titolo">{$error}</div>
	{else}
	{if is_array($contenuto)}
	{foreach from=$contenuto key=key item=item}
	{if $contenuto[$key]->approvato == 1}
	<div id="titolo">{$contenuto[$key]->titolo}</div>
	<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$contenuto[$key]->autore}">{$contenuto[$key]->autore}</a> il giorno {$contenuto[$key]->data} alle ore {$contenuto[$key]->ora} nella categoria <a href="categoria.php?cat={$contenuto[$key]->categoria}">{$contenuto[$key]->categoria}</a>.</div><br />
	<div id="news">{$contenuto[$key]->contenuto}</div>
	{/if}
	{/foreach}
	{if is_array($comments)}
	<br /><hr><br />
	{foreach from=$comments key=key item=item}
	{if $comments[$key]->approvato == 1}
	<fieldset><legend>#{$item@iteration} Commento inviato il giorno {$comments[$key]->data} alle ore {$comments[$key]->ora} da <a href="profilo.php?nickname={$comments[$key]->autore}">{$comments[$key]->autore}</a></legend>{$comments[$key]->contenuto}</fieldset><br />
	{/if}
	{/foreach}
	{else}
	<br /><hr><br />
	<div id="news">{$comments}</div>
	{/if}
	<br />
	<form action="" method="post">
	<textarea name="comment"></textarea><br />
	<input type="submit" value="Invia commento" />
	</form>
	{else}
	<div id="titolo">{$error}</div>
	{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
