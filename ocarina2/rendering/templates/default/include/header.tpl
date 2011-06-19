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
	<a href="Aindex.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Cerca nel sito</a> | <a href="#">Filler</a> | <a href="#">Filler</a><br />
	Bentornato {$utente} (<a href="admin/logout.php">Logout</a> | <a href="admin/profilo.php?nickname={$utente}">Profilo</a>)
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
