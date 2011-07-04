{*	/rendering/templates/admin/upload.tpl
	(C) Giovanni Capuano 2011
*}
{include file="$root_rendering/templates/$skin/include/header.tpl"}
	{if $utente == '' || $grado == ''}
		Accesso negato.
	{elseif ($grado < 4)}
		{if !$submit}
			<form action="" method="post" enctype="multipart/form-data">
			{for $var=1 to $multiple}
				<input name="image[]" type="file" size="40" /><br />
			{/for}
			<input name="upload" type="submit" value="Upload" />				
			</form><br />
			<div align="right">
			<form action="" method="get">
			<input name="multiple" type="text" size="1" />
			<input type="submit" value="Genera" />
			</form>
			</div>
		{else}
			{if isset($result)}
				{$result}
			{else}
				{for $var=0 to count($image)-1}
					<div align="center"><a href="{$url_immagini}/{$image[$var]}" target="_blank"><img src="{$url_immagini}/{$image[$var]}" width="200" height="200" alt="{$image[$var]}" /></a></div><br /><br />
					<b>Codice BBCode:</b> [img]{$url_immagini}/{$image[$var]}[/img]<br />
					<b>Codice BBCode con link:</b> [url={$url_immagini}/{$image[$var]}][img]{$url_immagini}/{$image[$var]}[/img][/url]<br />
					<b>Codice HTML:</b> &lt;img src="{$url_immagini}/{$image[$var]}" alt="{$image[$var]}" /&gt;<br />
					<b>Codice HTML con link:</b> &lt;a href="{$url_immagini}/{$image[$var]}" target="_blank">&lt;img src="{$url_immagini}/{$image[$var]}" alt="{$image[$var]}" /&gt;&lt;/a&gt;<hr />					
				{/for}
			{/if}
		{/if}
	{else}
		Accesso negato.
	{/if}
{include file="$root_rendering/templates/$skin/include/footer.tpl"}
