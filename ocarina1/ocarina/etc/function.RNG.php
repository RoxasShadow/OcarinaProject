<?php
/*
Questa classe permette di creare una stringa di 40 lettere casuali.
Modificando l' algoritmo di hash da sha1() a md5() è possibile ottenerne 32.
Eliminando, invece, il passaggio per tale funzione si ottiene il risultato
dell' RNG, ovvero 12 lettere casuali (è possibile aumentarle o diminuirle
aggiungendo o rimuovendo le variabili).
*/

function rng() {
// Genero numeri casuali
$a = rand(97,122);
$b = rand(97,122);
$c = rand(97,122);
$d = rand(97,122);
$e = rand(97,122);
$f = rand(97,122);
$g = rand(97,122);
$h = rand(97,122);
$i = rand(97,122);
$l = rand(97,122);
$m = rand(97,122);
$n = rand(97,122);

// Li converto in lettere
$ax = chr($a);
$bx = chr($b);
$cx = chr($c);
$dx = chr($d);
$ex = chr($e);
$fx = chr($f);
$gx = chr($g);
$hx = chr($h);
$ix = chr($i);
$lx = chr($l);
$mx = chr($m);
$nx = chr($n);

// Li unisco
$var = $ax.$bx.$cx.$dx.$ex.$fx.$gx.$hx.$ix.$lx.$mx.$nx;
// Cripto $var
$sha1 = sha1($var);
// Cripto di nuovo tutto in sha1
$rng = sha1($sha1);
return $rng;
}
?>
