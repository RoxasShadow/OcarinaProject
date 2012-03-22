<?php
/* Questa classe permette di creare un'anteprima di un testo */
function anteprima($testo, $lunghezza) {
	return (count($parole = explode(' ', $testo)) > $lunghezza) ? implode(' ', array_slice($parole, 0, $lunghezza)) : $testo;
}
?>
