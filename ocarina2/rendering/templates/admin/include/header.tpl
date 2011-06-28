<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" http://www.w3.org/TR/html4/loose.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$titolo}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content="{$description}" />
	<meta name="keywords" content="{$keywords}" />
	<link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/style.css" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$url_rendering}/templates/{$skin}/resources/ie7.css" /><![endif]-->
</head>
<body>
	<div id="wrapper">
	<h1><a href="#"><span>{$titolo}</span></a></h1>
	<div id="containerHolder">
	<div id="container">
	<div id="sidebar">
	<ul class="sideNav">
	{if $utente == '' || $grado == ''}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/login.php">Login</a></li>
	{elseif $grado > 5}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
	{elseif $grado == 5}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
		<li><a class="active">SEO</a></li>
		<li><a href="#">Filler ~</a></li>
	{elseif $grado == 4}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
		<li><a class="active">Webdesign</a></li>
		<li><a href="#">Filler ~</a></li>
	{elseif $grado == 3}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
		<li><a class="active">News</a></li>
		<li><a href="creanews.php">Crea news</a></li>
		<li><a href="modificanews.php">Modifica news</a></li>
		<li><a href="cancellanews.php">Cancella news</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="creapagina.php">Crea pagina</a></li>
		<li><a href="modificapagina.php">Modifica pagina</a></li>
		<li><a href="cancellapagina.php">Cancella pagina</a></li>
		<li><a class="active">Categorie</a></li>
		<li><a href="gestiscicategorie.php">Gestisci categorie</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
	{elseif $grado == 2}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
		<li><a class="active">Utenti</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">News</a></li>
		<li><a href="creanews.php">Crea news</a></li>
		<li><a href="modificanews.php">Modifica news</a></li>
		<li><a href="cancellanews.php">Cancella news</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="creapagina.php">Crea pagina</a></li>
		<li><a href="modificapagina.php">Modifica pagina</a></li>
		<li><a href="cancellapagina.php">Cancella pagina</a></li>
		<li><a class="active">Categorie</a></li>
		<li><a href="gestiscicategorie.php">Gestisci categorie</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
	{elseif $grado == 1}
		<li><a class="active">{$nomesito}</a></li>
		<li><a href="{$url_index}/logout.php">Logout</a></li>
		<li><a class="active">SEO</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Utenti</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">News</a></li>
		<li><a href="creanews.php">Crea news</a></li>
		<li><a href="modificanews.php">Modifica news</a></li>
		<li><a href="cancellanews.php">Cancella news</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="creapagina.php">Crea pagina</a></li>
		<li><a href="modificapagina.php">Modifica pagina</a></li>
		<li><a href="cancellapagina.php">Cancella pagina</a></li>
		<li><a class="active">Categorie</a></li>
		<li><a href="gestiscicategorie.php">Gestisci categorie</a></li>
		<li><a class="active">Pagine</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Uploader</a></li>
		<li><a href="#">Filler ~</a></li>
		<li><a class="active">Webdesign</a></li>
		<li><a href="#">Filler ~</a></li>
	{/if}
	</ul>
	</div>
	<h2><a class="active">{$titolo}</a></h2>
	<div id="main">
	<br /><br />
