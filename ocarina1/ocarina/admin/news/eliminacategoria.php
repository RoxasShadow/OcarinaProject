<?php
/* Permette di visualizzare le categorie e di aggiungerne di nuove */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

if(isset($_POST['categoria'])) {
	$categoria = $_POST['categoria'];

	// Mi connetto al database
	$db->connettidb();

	// Creo una select con tutte le categorie
	$result = $db->query("SHOW COLUMNS FROM news LIKE 'categoria'");

	// Conto i risultati
	$righe = $db->conta($result);

	// Prelevo le categorie
	for ($i=0;$i<$righe;$i++) {
		$row = mysql_fetch_row($result);
		$options  = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
		$num = count($options);
		for($g=0;$g<$num;$g++){
			$array[$g] = $func->escape($options[$g]);
		}
	}

	// Creo la query per modificare la categoria
	$query = "ALTER TABLE news CHANGE categoria categoria ENUM(";

	// Completo la query includendo l'array ed escludendo il valore $categoria
	$d = 0;
	$c = count($array);
	$exists = 0;
	$categoria = $func->escape($categoria);
	while($d < $c) {
		if($categoria !== $array[$d]) {
			$query .= '\''.$array[$d].'\',';
			$d++;
		}
		else {
			$d++;
			$exists++;
		}
	}

	// $exists deve essere 1 poichè la categoria da eliminare deve essere una sola
	if($exists !== 1) {
		// Mi disconnetto dal database
		$db->disconnettidb();

		$text = "La categoria non è stata trovata.";
		$smarty->assign("titolo", "Elimina categorie");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index.tpl");
		exit;
	}


	// Elimino l'ultimo carattere (,)
	$query = substr($query, 0, -1);
	$query .= ')';

	// Eseguo la query
	$db->query($query);

	// Mi disconnetto dal database
	$db->disconnettidb();

	$text = "La categoria è stata eliminata.";
	$smarty->assign("titolo", "Elimina categorie");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Creo la select con tutte le news
$text = 'Tramite questo form puoi eliminare una categoria.<br />
Attenzione però, facendo questo eliminerai automaticamente anche tutte le news che si trovano in essa!<br /><br />

<form method="post" action="">
Scegli la categoria da eliminare <select name="categoria">';

// Creo una select con tutte le categorie
$result = $db->query("SHOW COLUMNS FROM news LIKE 'categoria'");

// Conto i risultati
$righe = $db->conta($result);

for ($i=0;$i<$righe;$i++) {
	$row = mysql_fetch_row($result);
	$options  = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
	$num = count($options);
	for($g=0;$g<$num;$g++) {
		if($categoria == $options[$g]) {
			$text .= '<option value="'.$func->rescape($options[$g]).'" SELECTED>'.$func->rescape($options[$g]).'</option>';
		}
		$text .= '<option value="'.$func->rescape($options[$g]).'" '.$selected.'>'.$func->rescape($options[$g]).'</option>';
	}
}

// Mi disconnetto dal database
$db->disconnettidb();

$text .= '<br />
<input type="submit" value="Elimina">
</form>';

$smarty->assign("titolo", "Elimina categorie");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
