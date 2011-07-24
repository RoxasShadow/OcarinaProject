<?php
/* Questa classe include vari metodi per la gestione delle date */
class Date {
public function convertidata($data,$separatore) {
	$anno=substr($data,0,4);
	$mese=substr($data,5,2);
	$giorno=substr($data,8,2);
	$convertidata="$giorno$separatore$mese$separatore$anno";
	return $convertidata;
	/* Esempio d'uso:
	   convertidata(AAAA-MM-GG,"-");
	   Output:
	   $convertidata = GG-MM-AAAA;
	*/
}

// L' ora attuale in ora-minuti-secondi con il separatore dato
public function ore_min_sec($separatore) {
	$ore_min_sec = '';
	$ore_min_sec = date("G:i:s");
	$ore_min_sec = str_replace(":", $separatore, $ore_min_sec);
	return $ore_min_sec;
}

// L' ora attuale in ora-minuti con il separatore dato
public function ore_min($separatore) {
	$ore_min = '';
	$ore_min = date("G:i");
	$ore_min = str_replace(":", $separatore, $ore_min);
	return $ore_min;
}

// La data in giorno-mese-anno
public function data($separatore) {
	$data = '';
	$data = date("d-m-y");
	$data = str_replace("-", $separatore, $data);
	return $data;
}
}
?>
