<html>
<head>
	<title>{$titolo}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content="{$description}" />
	<meta name="keywords" content="{$keywords}" />
	<link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/style.css" />
	<meta name="robots" content="index,follow" />
</head>
<body>
	<div id="header">{$titolo}</div>
	<div id="menu" align="center">
	<a href="Aindex.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Cerca nel sito</a> | <a href="profilo.php">Profili</a> | <a href="#">Filler</a><br />
	{if $utente == ''}
		Benvenuto su {$nomesito}! Per usufruire di tutte le funzionalità che ti offriamo <a href="login.php">accedi</a> oppure <a href="registrazione.php">registrati</a>. (<a href="recuperapassword.php">Password persa?</a>)
	{else}
		Bentornato {$utente} (<a href="logout.php">Logout</a> | <a href="profilo.php?nickname={$utente}">Profilo</a> | <a href="modificaprofilo.php">Modifica profilo</a> | <a href="modificapassword.php">Modifica password</a>)
	{/if}
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
