<?php
/* Manda la skin a upload.php che la elabora */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

$text = '
Una skin deve essere formata dai seguenti componenti:<br /><br />
1. Cartella col nome della skin (preferibilmente senza spazi);<br />
2. Le sottocartelle "index", "news", "categorie", "sezioni", "ricerca", "resources" e "include". Al loro interno dovrà esserci un file vuoto chiamato index.html;<br />
3. All\' interno di "index" ci dovranno essere i file index.tpl (la index) e 404.tpl (la pagina di errore che appare in caso non siano presenti news);<br />
4. All\' interno di "news" ci dovranno essere i seguenti file:<br />
--commenti.tpl: l\' area dove si visualizza il commento;<br />
--nuovocommento.tpl: il form per inviare un commmento;<br />
--news.tpl: la pagina dove si visualizza la news;<br />
--endnews.tpl: la chiusura della pagina;<br />
6. All\' interno di "categorie" ci dovrà esserci categorie.tpl (la pagina dove si visualizzano le news associate alle categorie);<br />
7. All\' interno di "sezioni" ci dovrà esserci sezioni.tpl (la pagina dove si visualizzano le sezioni);<br />
8. All\' interno di "resources" ci dovranno essere i files CSS e una cartella "images" con le immagini della skin;<br />
9. All\' interno di "include" potrete mettere file da includere in altri template (ex: menu.tpl);<br />
10. Nel caso abbiate eliminato qualche funzione (ex: news), potrete eliminare tranquillamente la cartella e i relativi template.
11. Inserisci la cartella creata con le sottocartelle all\' interno in un archivio .zip (puoi usare il software gratuito WinRar o Winzip, reperibile su Google o Ark in caso di distribuzioni GNU/Linux);<br />
12. Se scarichi un template da un altro sito, ricorda di modificare correttamente i relativi link (ex: link ad immagini, a script o a CSS);<br />
13. Carica la skin con il seguente form.<br /><br />
<form name="upload" method="post" action="upload.php" enctype="multipart/form-data"> 
<input type="file" name="uploadfile"> 
<input type="submit" name="upload" value="Carica">
</form><br />
14. Attiva la skin inserendo il suo nome nel file "/core/class.Ocarina.php".
';
// Visualizzo la pagina
$smarty->assign("titolo", "Installa skin");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
