<?php/* Modifica il grado di un utente */// Includo le classi principaliinclude_once "../../core/class.Ocarina.php";include_once "../../core/class.MySQL.php";include_once "../../core/class.Functions.php";include_once "../../rendering/config.php";// Istanzio le classi$cms = new Ocarina;$db = new MySQL;$func = new Functions;/* Modifica il grado */if(isset($_POST['modificagrado'])) {	// Prelevo il grado	$grado = $func->escape($_POST['gradoutente']);	// Prelevo il nickname	$nickname = $func->escape($_POST['nicknameutente']);	// Mi connetto al database	$db->connettidb();	// Prelevo tutti gli indirizzi email e spedisco	$query3 = $db->query("UPDATE utenti SET grado='$grado' WHERE nickname='$nickname'");	// Mi disconnetto dal databse	$db->disconnettidb();	// Aggiorno i log se sono attivi	if($cms->cmslog() == 1) {		$codice = $_COOKIE[$func->cookie()];		$azione = 'modificato il grado di un utente ('.$nickname.')';		$db->log($codice, $azione);	}	// Mando l' avviso	$text = $_POST['nicknameutente'].' � ora un '.$func->escape($_POST['gradoutente']);	$smarty->assign("titolo", "Modifica grado utente");	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));	$smarty->assign("contents", $text);	$smarty->assign("url_cms", $cms->url_cms());	$smarty->assign("url_smartytpl", $cms->url_smartytpl());	$smarty->assign("cmsversion", $cms->cmsversion());	$smarty->display("admin/index/index.tpl");}// Prelevo gli utenti e li stampo nella tabella$db->connettidb();$text = '<table align="center" border="0"><tr><td><b>Nickname</b></td><td><b>Grado</b></td></tr>';$query = $db->query("SELECT nickname, grado FROM utenti ORDER BY grado DESC");while($riga = $db->estrai($query)) {	$nickname = $riga->nickname;	$grado = $riga->grado;	$text .= '<tr>	<td>'.$nickname.'</td>	<td>'.$grado.'</td>	</tr>';}$text .= '</table><br /><br />Con il seguente form puoi modificare il grado di un utente registrato.<br /><br /><form action="" method="post"><div align="center">Nickname<br /><select name="nicknameutente">';// Creo una query con i gradi e una con gli utenti$query = $db->query("SHOW COLUMNS FROM utenti LIKE 'grado'");$query2 = $db->query("SELECT nickname FROM utenti");// Stampo i nickname nella selectwhile ($riga = $db->estrai($query2)) {	$text .= '<option value="'.$func->rescape($riga->nickname).'">'.$func->rescape($riga->nickname).'</option>';}$text .= '</select><br /><br />Grado<br /><select name="gradoutente">';// Conto i risultati di $query$righe = $db->conta($query);// Poich� non ho una funzione dedicata vado col procedurale ed elenco i gradifor ($i=0;$i<$righe;$i++) {	$row = mysql_fetch_row($query);	$options = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));	$num = count($options);	for($g=0;$g<$num;$g++) {		$text .= '<option value="'.$func->rescape($options[$g]).'">'.$func->rescape($options[$g]).'</option>';	}}$text .= '</select><br /><input type="submit" name="modificagrado" value="Modifica"></form>';$smarty->assign("titolo", "Modifica grado utente");$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));$smarty->assign("contents", $text);$smarty->assign("url_cms", $cms->url_cms());$smarty->assign("url_smartytpl", $cms->url_smartytpl());$smarty->assign("cmsversion", $cms->cmsversion());$smarty->display("admin/index/index.tpl");?>