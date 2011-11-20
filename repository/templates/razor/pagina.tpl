{*	/rendering/templates/razor/pagina.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<section><div class="notice">{$error}</div></section>
	{else}
		{if is_array($pagina)}
			<section>
			<header>
			<h3>{$pagina[0]->titolo}</h3>
			<h4>Scritto da <a href="{$url_index}/profile/{$pagina[0]->autore}.html">{$pagina[0]->autore}</a> il giorno {$pagina[0]->data} alle ore {$pagina[0]->ora} nella categoria <a href="{$url_index}/category/{$pagina[0]->categoria}.html">{$pagina[0]->categoria}</a>. {if $pagina[0]->oraultimamodifica == $pagina[0]->ora}Ultima modifica {if $pagina[0]->dataultimamodifica == $pagina[0]->data}oggi{else} il giorno {$pagina[0]->dataultimamodifica}{/if} alle ore {$pagina[0]->ora} {if $pagina[0]->autoreultimamodifica !== $pagina[0]->autore}da parte di {$pagina[0]->autoreultimamodifica}.{/if}{/if}</h4>
			</header>
			<article>
			<p>{$pagina[0]->contenuto}</p>
			</article>
			<footer>
			<div id="voteresponse"></div>
			{if $utente !== ''}
				<a class="pointer" onclick="sendGet('{$url_index}/api.php?action=votepage&title={$pagina[0]->minititolo}', 'voteresponse', undefined, 'true', Array(9, 'Votato.'), 'Hai già votato questa pagina.'); setTimeout('sendGet(\'{$url_index}/api.php?action=page&title={$pagina[0]->minititolo}\', \'voto\', undefined, \'true\', undefined, undefined, \'votes\');', 200);">Vota questa pagina</a>
				{if $pagina[0]->voti == 1}
					(<a id="voto" class="no-prop">1</a> voto)
				{else}
					(<a id="voto" class="no-prop">{$pagina[0]->voti}</a> voti)
					{/if}
			{else}
				<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per votare questa news.
			{/if}
			</footer>
			</section>
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
