<?php
function ricercaarray($array, $cerca) {
	$risultato = false;
	$arr_keys = array_keys($array);
	foreach ($arr_keys as $key) {
		if ($array[$key] == $cerca) {
			$risultato = $key;
			break;
		}
	}
	return $risultato;
}
?>
