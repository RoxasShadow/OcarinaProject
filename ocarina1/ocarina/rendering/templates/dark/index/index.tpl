<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$titolo}</title>
<meta name="description" content="{$description}" />
<meta name="keywords" content="{$keywords}" />
{* Includo gli header statici (css, robots, content-type...) *}
{include file=$templates|cat:"dark/include/header.tpl"}
</head>

<body>

{* Includo il menù *}
{include file=$templates|cat:"dark/include/menu.tpl"}

<table id="colunica">
<tr>
<td>
<table style="width:50%; margin-left:auto; margin-right:auto;">
<tr>
<td style="width:50%">

{* NEWS *}
{foreach name=news item=item from=$scrivinews}

<div id="titolo">{$item.linktitolo}</div>
<div id="newsheader" align="center">Scritto {$item.data} alle ore {$item.ora} nella categoria {$item.categorialink}</div>
<br />
<div id="news">{$item.scrivinews}
</div>

<div align="right">{$item.commenti}</div>
<hr>
{/foreach}

<br /><br />

<div align="center">{$navigatore}</div>
{* FINE NEWS *}
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
{* Includo il footer *}
{include file=$templates|cat:"dark/include/footer.tpl"}
</body>
</html>
