{*	/rendering/templates/razor/news.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<section><div class="notice">{$error}</div></section>
	{else if isset($commentSended)}
		<section><div class="notice">{$commentSended}</div></section>
	{elseif is_array($news)}
		<section>
		<header>
		<h3>{$news[0]->titolo}</h3>
		<h4>Scritto da <a href="{$url_index}/profile/{$news[0]->autore}.html">{$news[0]->autore}</a> il giorno {$news[0]->data} alle ore {$news[0]->ora} nella categoria <a href="{$url_index}/category/{$news[0]->categoria}.html">{$news[0]->categoria}</a>. {if $news[0]->oraultimamodifica == $news[0]->ora}Ultima modifica {if $news[0]->dataultimamodifica == $news[0]->data}oggi{else} il giorno {$news[0]->dataultimamodifica}{/if} alle ore {$news[0]->ora} {if $news[0]->autoreultimamodifica !== $news[0]->autore}da parte di {$news[0]->autoreultimamodifica}.{/if}{/if}</h4>
		</header>
		<article>
		<p>{$news[0]->contenuto}</p>
		</article>
		<footer>
		<div id="voteresponse"></div>
		{if $utente !== ''}
			<a class="pointer" onclick="sendGet('{$url_index}/api.php?action=votenews&title={$news[0]->minititolo}', 'voteresponse', undefined, 'true', Array(9, 'Votato.'), 'Hai già votato questa news.'); setTimeout('sendGet(\'{$url_index}/api.php?action=news&title={$news[0]->minititolo}\', \'voto\', undefined, \'true\', undefined, undefined, \'votes\');', 200);">Vota questa news</a>
			{if $news[0]->voti == 1}
				(<a id="voto" class="no-prop">1</a> voto)
			{else}
				(<a id="voto" class="no-prop">{$news[0]->voti}</a> voti)
				{/if}
		{else}
			<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per votare questa news.
		{/if}
		</footer>
		</section>
		{if !is_array($commenti)}
			<br /><hr /><br />
			<section>
			<article>
			<div class="span-7">
			<p>{$commenti}</p>
			</div>
			</article>
			</section>
		{else}
			<br /><hr /><br />
			<section>
			{foreach from=$commenti key=key item=item name=news}
				<div class="span-24">
				<header>
				<h4><a href="{$url_index}/comment/{$commenti[$key]->id}.html">#{$item@iteration}</a> Commento inviato il giorno {$commenti[$key]->data} alle ore {$commenti[$key]->ora} da {if $commenti[$key]->autore !== ''}<a href="{$url_index}/profile/{$commenti[$key]->autore}.html">{$commenti[$key]->autore}</a>{else}Unknow{/if}. {if ((isset($grado)) && (is_numeric($grado)) && ($grado < 3))}<a href="{$url_index}/admin/cancellacommento.php?id={$commenti[$key]->id}">(X)</a>{/if} <a onclick="quota('{$item@iteration}');">Quota</a></h4>
				</header>
				<article>
				<div id="{$item@iteration}"><p>{$commenti[$key]->contenuto}</p></div>
				</article>
				</div>
				{if !$smarty.foreach.news.last}
					<hr class="space">
				{/if}
			{/foreach}
			</section>
		{/if}
		<br /><br />
		<section>
		{if !$logged}
			<div class="notice"><a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per commentare questa news.</div>
		{else}
			{if $bbcode == 1}
				{include file="$root_rendering/templates/$skin/include/bbcode.tpl"}
			{/if}
			<form method="post">
			<textarea name="comment" cols="59" rows="10" id="targetForm"></textarea><br />
			<input type="submit" value="Invia commento" /><input type="button" onclick="return sendSinglePost('{$url_admin}/preview.php?type=comment', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
			<div id="previewBox"></div>
			</form>
		{/if}
		</section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
