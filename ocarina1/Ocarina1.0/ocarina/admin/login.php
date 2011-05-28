<?php
/* Effettua il login */
// Includo le classi principali
include_once "../core/class.MySQL.php";
include_once "../core/class.Ocarina.php";
include_once "../core/class.Functions.php";
include_once "../rendering/config.php";
include_once "../etc/function.RNG.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

// Prima di procedere controllo se l' utente è già loggato
if(($func->logged() == 1) || ($func->logged() == 2)) {
	$text = 'Risulti già loggato, non hai bisogno di effettuare di nuovo il login.';

	// Visualizzo la pagina
	$smarty->assign("titolo", "Login");
	$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
	$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
	$smarty->assign("contents", $text);
	$smarty->assign("url_cms", $cms->url_cms());
	$smarty->assign("url_smartytpl", $cms->url_smartytpl());
	$smarty->assign("cmsversion", $cms->cmsversion());
	$smarty->display("admin/index/index2.tpl");
	exit;
}


// Prelevo i dati inseriti nel login
if(isset($_POST['login'])) {
	$nickname = $func->escape($_POST['nickname']);
	$password = $func->escape($_POST['password']); // Elimino gli spazi superflui e inserisco gli slash
	$password = $func->hash($password); // Converto in un algoritmo di hash

	// Mi connetto al database
	$db->connettidb();

	// Creo la query cercando una corrispondenza tra i dati di login
	$query = $db->query("SELECT nickname,password FROM utenti WHERE nickname='$nickname' AND password='$password'");

	// Verifico se la query ha dato risultati
	$risultati = $db->conta($query);

	// Se non ci sono state corrispondenze dò il messaggio di login fallito
	if($risultati <= 0) {
		$text = 'Il login non è stato effettuato.<br />Controlla i dati immessi e riprova.';

		// Visualizzo la pagina
		$smarty->assign("titolo", "Login");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
	}
	
	// Altrimenti avvio la procedura di login e creo un codice random univoco per identificare l' utente
	elseif($risultati > 0) {
		$rng = rng();
		$query2 = $db->query("UPDATE utenti SET codice = '$rng' WHERE nickname='$nickname' AND password='$password'");

		// Creo il cookie
		$ricorda = $func->escape($_POST['ricorda']);

		if($ricorda == '1') {
		setcookie($func->cookie(), $rng, time()+2592000, "/"); // 30gg
		}
		else {
		setcookie($func->cookie(), $rng, time()+72000, "/"); // 2h
		}

		// Visualizzo la pagina
		$text = 'Login effettuato. <a href="'.$cms->url_cms().'index.php">Clicca qui</a> per continuare.';
		$smarty->assign("titolo", "Login");
		$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
		$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
		$smarty->assign("contents", $text);
		$smarty->assign("url_cms", $cms->url_cms());
		$smarty->assign("url_smartytpl", $cms->url_smartytpl());
		$smarty->assign("cmsversion", $cms->cmsversion());
		$smarty->display("admin/index/index2.tpl");
	}
	// Mi disconnetto da database
	$db->disconnettidb();
	exit;
}

// Visualizzo la pagina
$text = '<form method="post" action="">
Nickname: <input name="nickname" type="text"><br />
Password: <input name="password" type="password"><br />
<input name="ricorda" type="checkbox" value="1">Ricorda accesso per 30gg<br />
<input name="login" type="submit" value="Login">
</form>';
$smarty->assign("titolo", "Login");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index2.tpl");
?>
