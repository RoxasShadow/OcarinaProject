<?php
include_once "../core/class.MySQL.php";
$db = new MySQL;

// Provo a "giocare" con la tabella temp con la classe di Ocarina

// Mi connetto al database
$db->connettidb();

// Inserisco dei dati
$db->query("INSERT INTO temp(test) VALUES('Hello world :D')");

// Provo a leggerli
$query = $db->query("SELECT id,test FROM temp");
while($riga = $db->estrai($query)) {
	$id = $riga->id;
	$test = $riga->test;
}

if(($id == 1) && ($test == 'Hello world :D')) {
	// Ho finito con questa tabella, la elimino
	$db->query("DROP TABLE temp");

	header("Location: installato.php");
	exit;
}
else {
	// Ho finito con questa tabella, la elimino
	$db->query("DROP TABLE temp");

	// Mi disconnetto
	$db->disconnettidb();
	die("E' accaduto un errore con la creazione e la lettura di un record.");
}
?>
