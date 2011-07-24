<?php
/* Modifica la news scelta da modificanews.php */
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

// Se non arriva il minititolo da modificanews.php dai un errore e ferma tutto
if((!isset($_POST['editaquestanews'])) && (!isset($_POST['modificanews']))) {
	$text = 'Questa pagina è richiamabile solo da <a href="modificanews.php">Modifica news</a>.';
	$smarty->assign("titolo", "Modifica news");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}

if(isset($_POST['modificanews'])) {
	// Creo le variabili con i dati
	$codice = $_COOKIE[$func->cookie()];
	$newautore = $db->nickname($codice);
	$newtitolo = $func->escape($_POST['newtitolo']);
	$newcategoria = $func->escape($_POST['newcategoria']);
	$newnews = $func->authescape($_POST['newnews']);
	$newora = $data->ore_min(':');
	$newdata = $data->data('-');
	$minititolo = $func->escape($_POST['minititolo']);

	// Mi connetto al database
	$db->connettidb();

	// Modifico la news
	$query = $db->query("UPDATE news SET autoreultimamodifica='$newautore', titolo='$newtitolo', categoria='$newcategoria', news='$newnews', oraultimamodifica='$newora', dataultimamodifica='$newdata' WHERE minititolo='$minititolo'");

	// Mi disconnetto dal database
	$db->disconnettidb();

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$azione = 'modificato una news ('.$minititolo.')';
		$db->log($codice, $azione);
	}

	// Mando l' avviso
	$text = 'La news è stata modificata.';
	$smarty->assign("titolo", "Modifica news");
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

// Catturo il minititolo della news da modificare
$minititolo = $func->escape($_POST['minititolo']);

// Prelevo i dati della news attuale
$query2 = $db->query("SELECT * FROM news WHERE minititolo='$minititolo'");

// Rinchiudo tutto nelle variabili
while ($riga = $db->estrai($query2)) {
	$autore = $func->rescape($riga->autore);
	$titolo = $func->rescape($riga->titolo);
	$news = $func->rescape($riga->news);
	$categoria = $func->rescape($riga->categoria);
}

$text = '
<form method="post" action="">
Titolo:<br /><input name="newtitolo" type="text" size="30" value="'.$titolo.'"><br />
Categoria:<br /><select name="newcategoria">';

// Creo una select con tutte le categorie
$result = $db->query("SHOW COLUMNS FROM news LIKE 'categoria'");

// Conto i risultati
$righe = $db->conta($result);

for ($i=0;$i<$righe;$i++) {
	$row=mysql_fetch_row($result);
	$options  = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));
	$num=count($options);
	for($g=0;$g<$num;$g++){
		if($categoria == $options[$g]) {
			$text .= '<option value="'.$func->rescape($options[$g]).'" SELECTED>'.$func->rescape($options[$g]).'</option>';
		}
		$text .= '<option value="'.$func->rescape($options[$g]).'" '.$selected.'>'.$func->rescape($options[$g]).'</option>';
	}
}

// Mi disconnetto dal database
$db->disconnettidb();

$text .= '</select><br />News<br />'.$func->textareabbcode('newnews',$news).'<br /><input type="hidden" name="minititolo" value="'.$func->escape($_POST['minititolo']).'"><input name="modificanews" type="submit" value="Modifica"></form>';
$smarty->assign("titolo", "Modifica news");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
