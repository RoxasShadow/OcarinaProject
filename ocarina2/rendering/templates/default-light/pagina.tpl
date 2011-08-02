{*	/rendering/templates/default/pagina.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($error)}
		<div class="titolo">{$error}</div>
	{else}
		{if is_array($pagina)}
			<div class="titolo">{$pagina[0]->titolo}</div>
			<div class="newsheader" align="center">Scritto da <a href="{$url_index}/profile/{$pagina[0]->autore}.html">{$pagina[0]->autore}</a> il giorno {$pagina[0]->data} alle ore {$pagina[0]->ora} nella categoria <a href="{$url_index}/category/{$pagina[0]->categoria}.html">{$pagina[0]->categoria}</a>. {if $pagina[0]->oraultimamodifica == $pagina[0]->ora}Ultima modifica {if $pagina[0]->dataultimamodifica == $pagina[0]->data}oggi{else} il giorno {$pagina[0]->dataultimamodifica}{/if} alle ore {$pagina[0]->ora} {if $pagina[0]->autoreultimamodifica !== $pagina[0]->autore}da parte di {$pagina[0]->autoreultimamodifica}.{/if}{/if}</div><br />
			<div class="news"><p>{$pagina[0]->contenuto}</p></div><br />
			{if $utente !== ''}
				<a href="{$url_index}/vote.php?action=page&titolo={$pagina[0]->minititolo}">Vota questa pagina</a>
				{if $pagina[0]->voti == 1}
					(1 voto)
				{else}
					({$pagina[0]->voti} voti)
				{/if}
			{else}
				<a href="{$url_index}/registrazione.php">Registrati</a> o <a href="{$url_index}/login.php">accedi</a> per votare questa pagina.
			{/if}
		{/if}
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
