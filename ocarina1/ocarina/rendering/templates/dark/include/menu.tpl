<div id="header">{$titolo}</div>
<div id="menu" align="center">
<a href="index.php">News</a> | <a href="archivio.php">Archivio</a> | <a href="ricerca.php">Ricerca</a><br />
{* Se sei loggato *}
{if $cookie eq 1 or $cookie eq 2}
Bentornato {$nickname} (<a href="admin/logout.php">Logout</a> | <a href="admin/profilo.php?nickname={$nickname}">Profilo</a>)
{else}
Benvenuto visitatore (<a href="admin/registrazione.php">Registrati</a> | <a href="admin/login.php">Accedi</a>)
{/if}
</div>
