{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div id="titolo">{$errore}</div>
	{else if isset($commentSended)}
		<div id="titolo">{$commentSended}</div>
	{elseif is_array($news)}
		{foreach from=$news key=key item=item}
			{if $news[$key]->approvato == 1}
				<div id="titolo">{$news[$key]->titolo}</div>
				<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$news[$key]->autore}">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="categoria.php?cat={$news[$key]->categoria}">{$news[$key]->categoria}</a>.</div><br />
				<div id="news">{$news[$key]->contenuto}</div>
			{/if}
		{/foreach}
		{if !is_array($commenti)}
			<br /><hr /><br />
			<div id="news">{$commenti}</div>
		{else}
			<br /><hr /><br />
			{foreach from=$commenti key=key item=item}
				<fieldset><legend>#{$item@iteration} Commento inviato il giorno {$commenti[$key]->data} alle ore {$commenti[$key]->ora} da <a href="profilo.php?nickname={$commenti[$key]->autore}">{$commenti[$key]->autore}</a></legend>{$commenti[$key]->contenuto}</fieldset><br />
			{/foreach}
		{/if}
		<br />
		<form action="" method="post">
		<textarea name="comment" cols="59" rows="10"></textarea><br />
		<input type="submit" value="Invia commento" />
		</form>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
