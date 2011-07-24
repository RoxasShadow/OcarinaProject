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
	$result = $db->query("SHOW COLUMNS FROM pagine LIKE 'categoria'");

	// Conto i risultati
	$righe = $db->conta($result);

	// Prelevo le categorie
	for ($i=0;$i<$righe;$i++) {
		$row=mysql_fetch_row($result);
		$options  = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));
		$num=count($options);
		for($g=0;$g<$num;$g++){
			$array[$g] = $func->escape($options[$g]);
		}
	}

	// Aggiungo la nuova categoria a quelle attuali
	$count = count($array);
	$array[$count] = $func->escape($categoria);

	// Creo la query per modificare la categoria
	$query = "ALTER TABLE pagine CHANGE categoria categoria ENUM(";

	// Completo la query includendo l'array
	$d = 0;
	$c = count($array);
	while($d < $c) {
		$query .= '\''.$array[$d].'\',';
		$d++;
	}

	// Elimino l'ultimo carattere (,)
	$query = substr($query, 0, -1);
	$query .= ')';

	// Eseguo la query
	$db->query($query);

	// Mi disconnetto dal database
	$db->disconnettidb();

	$text = "La categoria è stata creata.";
	$smarty->assign("titolo", "Crea categorie");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index.tpl");
}

// Creo la select con tutte le news
$text = '
Tramite questo form puoi creare una categoria.<br /><br />

<form method="post" action="">
Nuova categoria <input type="text" name="categoria"><br />
<input type="submit" value="Crea">
</form>';

$smarty->assign("titolo", "Crea categorie");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
