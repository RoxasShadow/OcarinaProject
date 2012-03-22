<?php
/* Crea le news */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";
include_once "../../etc/class.Date.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$data = new Date;

/* L' invio delle news */

if(isset($_POST['creanews'])) {
	// Creo le variabili con i dati
	$codice = $_COOKIE[$func->cookie()];
	$autore = $db->nickname($codice);
	$titolo = $func->escape($_POST['titolo']);
	$categoria = $func->escape($_POST['categoria']);
	$news = $func->authescape($_POST['news']);
	$minititolo = $func->permalink($titolo);
	$ora = $data->ore_min(':');
	$data = $data->data('-');
	$striptitolo = $func->rescape($titolo); // Rimuovo gli slashes per il controllo nel db

	// Controllo se nel database non ci sia una news con un titolo uguale
	$db->connettidb();
	$query = $db->query("SELECT titolo FROM news WHERE titolo = '$titolo'");
	$conta = $db->conta($query);

	// Se esiste avviso e blocco lo script
	if($conta > 0) {
		$text = 'Esiste già una news con lo stesso titolo. Prova a modificarlo e riprova.';
		$smarty->assign("titolo", "Crea news");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index.tpl");
		exit;
	}

	// Altrimenti invio la news al database
	$query2 = $db->query("INSERT INTO news (autore, titolo, minititolo, news, categoria, data, ora) VALUES ('$autore', '$titolo', '$minititolo', '$news', '$categoria', '$data', '$ora')");

	// Mi disconnessione dal database
	$db->disconnettidb();

	// Aggiorno la sitemap
	if($cms->sitemapgen() == 1) {
		if($cms->sitemapalert() == 1) {
			$alert = 1;
		}
		elseif($cms->sitemapalert() == 0) {
			$alert = 0;
		}

		$db->aggiornasitemap($cms->url(), $cms->linknews(), $cms->linksezioni(), $cms->root(), $alert);
	}

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$azione = 'creato una news ('.$minititolo.')';
		$db->log($codice, $azione);
	}

	// Mando l' avviso
	$text = 'La news è stata creata.';
	$smarty->assign("titolo", "Crea news");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Poichè i processi di prima finivano con un exit, se siamo qui è solo perchè siamo loggati
$codice = $_COOKIE[$func->cookie()];

// Mi connetto al database
$db->connettidb();

$text = '
<form method="post" action="">
Titolo:<br /><input name="titolo" type="text" size="30"><br />
Categoria:<br /><select name="categoria">';

// Creo una select con tutte le categorie
$result = $db->query("SHOW COLUMNS FROM news LIKE 'categoria'");

// Conto i risultati
$righe = $db->conta($result);

for ($i=0;$i<$righe;$i++) {
	$row = mysql_fetch_row($result);
	$options = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
	$num = count($options);
	for($g=0;$g<$num;$g++){
		$text .= '<option value="'.$func->rescape($options[$g]).'">'.$func->rescape($options[$g]).'</option>';
	}
}

// Mi disconnetto dal database
$db->disconnettidb();

$text .= '</select><br />News<br />'.$func->textareabbcode('news','').'<br /><input name="creanews" type="submit" value="Invia"></form>';

$smarty->assign("titolo", "Crea news");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
