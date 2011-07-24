<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$titolo}</title>
<meta name="description" content="{$description}" />
<meta name="keywords" content="{$keywords}" />
{* Includo gli header statici (css, robots, content-type...) *}
{include file=$templates|cat:"dark/include/header.tpl"}
{* Il tag literal permette di non far parsare al motore le parentesi graffe *}
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
</script>
{/literal}
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
<div id="titolo">{$titolo}</div>
{* NEWS *}
<div id="newsheader">News scritta {$data} da {$autorelink} alle ore {$ora} nella categoria {$categorialink}</div><br />
<div id="news">{$scrivinews}</div><br /><br /><hr><br />
{* FINE NEWS *}

{* COMMENTI *}
{foreach name=commenti item=item from=$commenti}
<fieldset><legend>Commento inviato il {$item.data_com} alle ore {$item.ora_com} da {$item.autore_com_link}</legend><a onclick="javascript:quota(this);">{$item.commento_bbcode}</a></fieldset><br />
{/foreach}

{* NUOVO COMMENTO *}
{* Controllo se è loggato, se lo è mostro il form, altrimenti avviso *}
{if $cookie eq 0}
Per commentare devi <a href="admin/registrazione.php">registrarti</a> o <a href="admin/login.php">accedere</a>.
{elseif $cookie eq 1 or $cookie eq 2}
<form action="commentook.php" method="post">
Commento:<br>
{$textarea}<br />
<input name="commenta" type="submit" value="Invia commento">
</form>
{/if}

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

