{*	/rendering/templates/admin/gestiscicategorie.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if (($grado == '') || ($grado > 3))}
		Accesso negato.
	{elseif !$submit && !isset($result)}
		<form action="" method="post">
		Crea categoria per le news<br />
		<input type="text" name="categoria_news" /><br />
		<input type="submit" name="creaCategoriaNews" value="Crea categoria" /><br /><br />
		
		Crea categoria per le pagine<br />
		<input type="text" name="categoria_pagina" /><br />
		<input type="submit" name="creaCategoriaPagine" value="Crea categoria" /><br /><br />
		
		Rimuovi categoria per le news<br />
		<select name="categoria_news_rimuovi">
		{foreach from=$categorie_news key=key item=item}
			<option value="{$categorie_news[$key]}">{$categorie_news[$key]}</option>
		{/foreach}
		</select><br />
		<input type="submit" name="rimuoviCategoriaNews" value="Rimuovi categoria" /><br /><br />
		
		Rimuovi categoria per le pagine<br />
		<select name="categoria_pagina_rimuovi">
		{foreach from=$categorie_pagine key=key item=item}
			<option value="{$categorie_pagine[$key]}">{$categorie_pagine[$key]}</option>
		{/foreach}
		</select><br />
		<input type="submit" name="rimuoviCategoriaPagine" value="Rimuovi categoria" />
		</form>
	{elseif $submit || (!$submit && isset($result))}
		{$result}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
