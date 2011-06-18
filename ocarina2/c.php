<?php
include "core/class.News.php";
$news = new News();

for($i=0; $i<100; $i++) {
	$array = array('Roxas Shadow', 'Test #'.$i, 'test-'.$i, 'Hello, world!<br />I\'m '.$i.'!', 'Senza categoria', date('d-m-y'), date('G:m:s'), 1);
	$array = $news->purge($array);
	if(!$news->createNews($array)) {
		echo 'È accaduto un errore.';
	}
	else {
		echo 'La news è stata creata con successo.';
	}
	echo '<br /><br />';
}
