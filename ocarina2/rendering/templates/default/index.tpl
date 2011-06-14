<html>
	<head>
		<title>{$titolo|default:"no title"|capitalize}</title>
	</head>
	<body>
		Hello, {$Nome} {$Cognome|capitalize}!<br />
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
	</body>
</html>
