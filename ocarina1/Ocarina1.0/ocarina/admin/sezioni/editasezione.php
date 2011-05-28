<?php
/* Modifica la sezione scelta da modificasezione.php */
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

/* L' invio delle sezioni */

// Se non arriva il minititolo da modificanews.php dai un errore e ferma tutto
if((!isset($_POST['editaquestasezione'])) && (!isset($_POST['modificasezione']))) {
	$text = 'Questa pagina è richiamabile solo da <a href="'.$cms->url_cms().'modificanews.php">Modifica news</a>.';
	$smarty->assign("titolo", "Modifica sezione");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
	exit;
}

if(isset($_POST['modificasezione'])) {
	// Mi connetto al database
	$db->connettidb();

	// Creo le variabili con i dati
	$codice = $_COOKIE[$func->cookie()];
	$newtitolo = $func->escape($_POST['newtitolo']);
	$newminititolo = $func->escape($_POST['newminititolo']);
	$newcontenuto = $func->authescape($_POST['newcontenuto']);
	$newcategoria = $func->escape($_POST['newcategoria']);
	$newautore = $db->nickname($codice);
	$dataultimamodifica = $data->data("-");
	$autoreultimamodifica = $db->nickname($codice);
	$minititolo = $func->escape($_POST['minititolo']);

	// Modifico la sezione
	$query = $db->query("UPDATE pagine SET titolo='$newtitolo', minititolo='$newminititolo', contenuto='$newcontenuto', categoria='$newcategoria', dataultimamodifica='$dataultimamodifica', autoreultimamodifica='$autoreultimamodifica' WHERE minititolo='$minititolo'");

	// Mi disconnessione dal database
	$db->disconnettidb();

	// Aggiorno i log se sono attivi
	if($cms->cmslog() == 1) {
		$azione = 'modificato una sezione ('.$minititolo.')';
		$db->log($codice, $azione);
	}

	// Mando l' avviso
	$text = 'La sezione è stata modificata.';
	$smarty->assign("titolo", "Modifica sezione");
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

// Catturo il minititolo della sezione da modificare
$minititolo = $func->escape($_POST['minititolo']);

// Prelevo i dati della sezione attuale
$query2 = $db->query("SELECT * FROM pagine WHERE minititolo='$minititolo'");

// Rinchiudo tutto nelle variabili
while ($riga = $db->estrai($query2)) {
	$titolo = $func->rescape($riga->titolo);
	$minititolo = $func->rescape($riga->minititolo);
	$contenuto = $func->rescape($riga->contenuto);
	$categoria = $func->rescape($riga->categoria);
	$autore = $func->rescape($riga->autore);
}

$text = '
<form method="post" action="">
Titolo:<br /><input name="newtitolo" type="text" size="30" value="'.$titolo.'"><br />
Minititolo:<br /><input name="newminititolo" type="text" size="30" value="'.$minititolo.'"><br />
Categoria:<br /><select name="newcategoria">';

// Creo una select con tutte le categorie
$result = $db->query("SHOW COLUMNS FROM pagine LIKE 'categoria'");

// Conto i risultati
$righe = $db->conta($result);

for ($i=0;$i<$righe;$i++) {
	$row = mysql_fetch_row($result);
	$options  = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
	$num = count($options);
	for($g=0;$g<$num;$g++){
		if($categoria == $options[$g]) {
			$text .= '<option value="'.$func->rescape($options[$g]).'" SELECTED>'.$func->rescape($options[$g]).'</option>';
		}
		$text .= '<option value="'.$func->rescape($options[$g]).'" '.$selected.'>'.$func->rescape($options[$g]).'</option>';
	}
}

// Mi disconnetto dal database
$db->disconnettidb();

$text .= '</select><br />Sezione<br />'.$func->textareabbcode('newcontenuto',$contenuto).'<br /><input type="hidden" name="minititolo" value="'.$minititolo.'"><input name="modificasezione" type="submit" value="Modifica"></form>';
$smarty->assign("titolo", "Modifica sezione");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
