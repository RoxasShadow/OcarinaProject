{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if isset($errore)}
		<div class="titolo">{$errore}</div>
	{else if isset($commentSended)}
		<div class="titolo">{$commentSended}</div>
	{elseif is_array($news)}
		{foreach from=$news key=key item=item}
			{if $news[$key]->approvato == 1}
				<div class="titolo">{$news[$key]->titolo}</div>
				<div class="newsheader" align="center">Scritto da <a href="profilo.php?nickname={$news[$key]->autore}">{$news[$key]->autore}</a> il giorno {$news[$key]->data} alle ore {$news[$key]->ora} nella categoria <a href="categoria.php?cat={$news[$key]->categoria}">{$news[$key]->categoria}</a>.</div><br />
				<div class="news">{$news[$key]->contenuto}</div>
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
					<fieldset><legend><a href="commento.php?id={$commenti[$key]->id}">#{$item@iteration}</a> Commento inviato il giorno {$commenti[$key]->data} alle ore {$commenti[$key]->ora} da <a href="profilo.php?nickname={$commenti[$key]->autore}">{$commenti[$key]->autore}</a>.</legend><a onclick="javascript:quota(this);">{$commenti[$key]->contenuto}</a></fieldset><br />
				{/if}
			{/foreach}
		{/if}
		<br />
		{if $bbcode == 1}
			{literal}
			<script type="text/javascript">
			function quota(objDom) {
			    var browserName = navigator.appName; 
			    var txtToQuote = "";
				var ante = "[quote]";
				var dopo = "[/quote]";
	
			    if (browserName == "Microsoft Internet Explorer") {
				txtToQuote = objDom.innerText;
			    }
			    else {
				txtToQuote = objDom.textContent;
				txtToQuote2 = ante+txtToQuote+dopo;
			    }

			    document.getElementById("txtQuota").value = txtToQuote2;
			}
			function add(emoticons) {
			    var text = document.getElementById("txtQuota").value;
			    document.getElementById("txtQuota").value = text + emoticons;
			}
			function requestcolor() {
			    var colore = prompt("Digita il nome del colore (esempio: red, black, white)");
			    add('[color='+colore+'][/color]');
			}
			</script>
			{/literal}
			<a onclick="javascript:add('[b][/b]');"><b>Grassetto</b></a>
			<a onclick="javascript:add('[i][/i]');"><b>Corsivo</b></a>

			<a onclick="javascript:add('[u][/u]');"><b>Sottolineato</b></a>
			<a onclick="javascript:add('[s][/s]');"><b>Barrato</b></a>
			<a onclick="javascript:requestcolor();"><b>Colore</b></a>
			<a onclick="javascript:add('[url=http://][/url]');"><b>URL</b></a>
			<a onclick="javascript:add('[spoiler][/spoiler]');"><b>Spoiler</b></a>
			<a onclick="javascript:add('[left][/left]');"><b>Allineato a sinistra</b></a>
			<a onclick="javascript:add('[center][/center]');"><b>Allineato a centro</b></a>
			<a onclick="javascript:add('[right][/right]');"><b>Allineato a destra</b></a>
			<a onclick="javascript:add('[br]');"><b>Accapo</b></a>

			<a onclick="javascript:add('[code][/code]');"><b>Codice</b></a>
			<a onclick="javascript:add('[quote][/quote]');"><b>Citazione</b></a>
		{/if}
		<form action="" method="post">
		<textarea name="comment" cols="59" rows="10" class="txtQuota"></textarea><br />
		<input type="submit" value="Invia commento" />
		</form>
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
