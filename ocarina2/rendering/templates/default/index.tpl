{* This is a comment, and is visible only in .tpl file and not in the HTML source. *}
<html>
	<head>
		<title>{$titolo|default:"no title"|capitalize}</title>
		<style type="text/css">
		{* Quando si usano le graffe (CSS, Javascript...), Smarty cerca di interpetrarle e genererà quindi un errore. Usare quindi il blocco literal *}
		{literal}
		p {
		    font-style: italic;
		}
		{/literal}
		</style>
	</head>
	<body>
		Hello, {$nome} {$cognome|capitalize}!<br />
		Your email ({mailto address=$email encode='javascript_charcode'}) is protected by spambot ;)<br />
		Today is {$smarty.now|date_format:"%d-%m-%Y"}<br />
		<select name=user>
			{html_options values=$values output=$names selected="3"}
		</select>
		<br />
		<table>
		{foreach $users as $user}
			{strip}
  		<tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
     			<td>{$user.name|capitalize}</td>
      			<td>{$user.phone|capitalize}</td>
   		</tr>
			{/strip}
		{/foreach}
		</table>
		<br />
		 {textformat}{$testo}{/textformat}
	</body>
</html>
