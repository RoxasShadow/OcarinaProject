rima<?php
/* Permette di recuperare la password */
// Includo le classi principali
include_once "../core/class.MySQL.php";
include_once "../core/class.Ocarina.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";
include_once "../etc/function.RNG.php";
include_once "../etc/class.Email.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;
$email = new Emailer;

// Prima di procedere controllo se l' utente è già loggato
if(($func->logged() == 1) || ($func->logged() == 2)) {
	$text = 'Risulti già loggato, devi prima effettuare il logout per recuperare la password.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Recupera password");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

if(isset($_POST['recuperapassword'])) {
	$nickname = $func->escape($_POST['nickname']);
	$email = $func->escape($_POST['email']);

	// Confronto i dati con il database
	$db->connettidb(); // Mi connetto al database
	$query = $db->query("SELECT nickname, email FROM utenti WHERE nickname='$nickname' AND email='$email'");
	$conta = $db->conta($query);
	$db->disconnettidb(); // Mi disconnetto dal database

	// Verifico se i dati sono corretti per poi dare un errore
	if($conta <= 0) {
		$text = 'I dati inseriti non sono associati a nessun account. Riprova verificando i dati immessi.';
		$smarty->assign("titolo", "Recupera password");
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
		exit;
	}

	// Genero una nuova password con l'RNG e la inserisco nel database
	$rng = rng(); // Creo la password
	$nuovapassword = $func->hash($rng); // La passo per un algoritmo di hash
	$db->connettidb(); // Mi connetto al database
	$query = $db->query("UPDATE utenti SET password='$nuovapassword' WHERE nickname='$nickname' AND email='$email'");
	$db->disconnettidb(); // Mi disconnetto dal database

	// Invio la password via email
	$mittente = $cms->email();
	$destinatario = $func->rescape($email);
	$oggetto = 'Recupero password - '.$cms->nomesito();
	$testo = 'Ciao '.$nickname.'.
Mediante il servizio Recupera password di '.$cms->nomesito().' hai richiesto il recupero della tua password.
Essa è stata generata automaticamente e potrai modificarla tramite l\'apposita pagina Modifica password.

La tua password è la seguente: '.$rng.'

ATTENZIONE: Se non sei tu il richiedente della password, ti chiediamo di ignorare questa email.

A presto,
'.$cms->nomesito().'.';
	mail($mittente,$destinatario,$oggetto,$testo);

	$text = 'La password è stata generata ed è stata inviata al tuo indirizzo email.';
	// Visualizzo la pagina
	$smarty->assign("titolo", "Recupera password");
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}

// Visualizzo il form di recupero
$text = 'Se hai perso la password con cui accedere a '.$cms->nomesito().' puoi utilizzare il seguente form per riceverne una nuova via email.<br />
Essa sarà generata all\'istante poichè la vecchia password non è recuperabile per motivi di sicurezza.<br />
Una volta che otterrai la password, potrai sempre <a href="modificapassword.php">modificarla</a>.<br /><br />
<form action="" method="post">
 Nickname<br />
 <input name="nickname" type="text" value="" /><br /><br />
 Email<br />
 <input name="email" type="text" value="" /><br />
 <input name="recuperapassword" type="submit" value="Recupera password" /><br />
</form>';
$smarty->assign("titolo", "Recupera password");
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
