<?php
/* Visualizza i profili degli utenti */
// Includo le classi principali
include_once "../core/class.Ocarina.php";
include_once "../core/class.MySQL.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

if((!isset($_GET['nickname'])) AND (!isset($_POST['nickname']))) {
	$text = '<form action="" method="post">
Utente:<br /><select name="nickname">';

// Mi connetto al database
$db->connettidb();

// Creo una select con tutte le categorie
$query = $db->query("SELECT nickname FROM utenti");

while($riga = $db->estrai($query)) {
	$text .= '<option value="'.$func->rescape($riga->nickname).'">'.$func->rescape($riga->nickname).'</option>';
}

// Mi disconnetto dal database
$db->disconnettidb();

$text .= '</select><input type="submit" name="submit" value="Accedi">
</form>';

$nickname = 'Profilo'; // Per il titolo della pagina
}
elseif((isset($_GET['nickname'])) OR (isset($_POST['nickname']))) {

	// Prelevo il nickname
	if($_GET['nickname']) {
		$nickname = $func->escape($_GET['nickname']);
	}
	elseif($_POST['nickname']) {
		$nickname = $func->escape($_POST['nickname']);
	}

	// Mi connetto al database
	$db->connettidb();
	
	// Effettuo la query per prelevare i dati
	$query = $db->query("SELECT nickname,email,grado,dataregistrazione,avatar FROM utenti WHERE nickname='$nickname'");
	$count = $db->conta($query);
	if($count <= 0) {
		$text = 'Utente non trovato.';
		$nickname = 'Utente non trovato.';
	}
	else {
	
		while($riga = $db->estrai($query)) {
			$nickname = $func->rescape($riga->nickname);
			$email = $func->rescape($riga->email);
			$grado = $func->rescape($riga->grado);
			$dataregistrazione = $func->rescape($riga->dataregistrazione);
			$avatar = $func->rescape($riga->avatar);
		}

		// Mi disconnetto dal database
		$db->disconnettidb();

		$text = '<div align="center"><h2>'.$nickname.'</h2>';

		// Un controllo per l'avatar
		if($avatar !== '') {
			$text .= '<br /><img src="'.$avatar.'"><br /><br />';
		}
		else {
			$text .= '<br />';
		}

		$text .= '
<table border="0" style="background:white; border:0px;">
<td><b>Email:</b> '.$email.'<td />
<td><b>Grado:</b> '.$grado.'<td />
<td><b>Registrato il:</b> '.$dataregistrazione.'<td />
</table>
</div>';
	}
}

$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("titolo", $nickname);
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
