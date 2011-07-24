<?php
/* Manda la skin a editaskin.php che la modifica */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

$text = 'Grazie a questa pagina puoi modificare una skin.<br />
Per procedere, seleziona la skin che desideri modificare e clicca sul bottone "Modifica".<br />
Ricorda che però i percorsi dei file sono predefiniti, quindi in caso che alcuni file sono inseriti in cartelle diverse o con nomi diversi o non siano presenti non sarà possibile modificarli e si dovrà intervenire manualmente con un client FTP.<br /><br />';

// Apro la cartella dei template
$dir = $cms->dir_smarty().'templates/';
$apri = opendir($dir);
$f = array();

// Ciclo i file
while (false !== ($tpldir = readdir($apri))) {
	if(($tpldir !== '.') AND ($tpldir !== '..') AND($tpldir !== 'admin')) {
		$f[] = $tpldir;
	}
}

// Li ordino
sort($f);

$text .= '<form action="editaskin.php" method="post">
<div align="center">
Seleziona skin:<br />
<select name="skin">
';

// Li stampo
foreach($f as $tpldir) {
	$text .= '<option value="'.$tpldir.'">'.$tpldir.'</option>';
}

$text .= '</select><br /><br />
Seleziona template:<br />
<select name="template">
<option>--- INDEX ---</option>
<option value="index/index.tpl">Index</option>
<option value="index/404.tpl">404</option>
<option>--- NEWS ---</option>
<option value="news/commenti.tpl">Commenti</option>
<option value="news/news.tpl">News</option>
<option value="news/endnews.tpl">Endnews</option>
<option value="news/nuovocommento.tpl">Nuovo commento</option>
<option>--- CATEGORIE ---</option>
<option value="categorie/categorie.tpl">Categorie</option>
<option>--- SEZIONI ---</option>
<option value="sezioni/sezioni.tpl">Sezioni</option>
<option value="sezioni/404.tpl">404</option>
<option>--- RICERCA ---</option>
<option value="ricerca/risultati.tpl">Risultati</option>
<option>--- INCLUDE---</option>
<option value="include/menu.tpl">Menù (se presente)</option>
<option value="include/header.tpl">Header (se presente)</option>
<option value="include/footer.tpl">Footer (se presente)</option>
<option>--- STYLE ---</option>
<option value="resources/style.css">Style.css (se presente)</option>
</select>
<input type="submit" name="modificaskin" value="Modifica">
</div>
</form>
';

// Visualizzo la pagina
$smarty->assign("titolo", "Modifica skin");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
