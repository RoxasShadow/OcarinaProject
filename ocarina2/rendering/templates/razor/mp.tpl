{*	/rendering/templates/razor/mp.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if !$logged}
		<section><div class="notice">{$result}</div></section>
	{elseif !$result}
		<section><div class="notice">Nessun MP ricevuto.</div></section>
	{else}
		<section>
		{if is_numeric($id)}
			<b>Da:</b> <a href="{$url_index}/profile/{$result[0]->mittente}.html">{$result[0]->mittente}</a><br />
			<b>Data:</b> {$result[0]->data}<br />
			<b>Oggetto:</b> {$result[0]->oggetto}<br />
			<b>Contenuto:</b><br />
			{$result[0]->contenuto}
		{else}
			<ul>
			{foreach from=$result key=key item=item}
				{if $result[$key]->letto == 1}
					<li><a href="{$url_index}/mp/{$result[$key]->id}.html">{$result[$key]->oggetto}</a> (Inviato il {$result[$key]->data} da {$result[$key]->mittente})</li>
				{else}
					<li><font color="red">&bull;</font> <a href="{$url_index}/mp/{$result[$key]->id}.html">{$result[$key]->oggetto}</a> (Inviato il {$result[$key]->data} da {$result[$key]->mittente})</li>
				{/if}
			{/foreach}
			</ul>
		{/if}
		</section>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
