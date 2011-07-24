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
<div id="titolo">Risultati</div>
{* RICERCA *}
{$risultati}
<br /><br /><hr><br />
<div id="summary">Cerca nel sito</div>
<form action="" method="post">
<input name="keyword" size="25" type="text"><br>
<input name="ricerca" value="Cerca" type="submit"></p>
</form>
{* FINE RICERCA *}
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
