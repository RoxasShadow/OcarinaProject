<?php
include "core/class.Rendering.php";
$c = new Rendering();
$array1 = array("nome", "cognome", "email");
$array2 = array("Giovanni", "capuano", "webmaster@giovannicapuano.net");
$c->addValue('titolo', 'Test page');
$c->addValue('testo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non diam enim. Donec ultrices suscipit quam. Praesent urna sapien, commodo nec malesuada quis, ornare at leo. Aenean at mauris nibh. Nullam eu erat eros. Nam sollicitudin leo lorem, sed blandit mi. Donec aliquet imperdiet nibh. Pellentesque et nisl dignissim leo euismod gravida. Pellentesque consequat rutrum sem, non porttitor sem dapibus sed. Mauris eleifend sagittis enim ac scelerisque. Aliquam vulputate dui id turpis gravida eget adipiscing velit ullamcorper. Sed tincidunt euismod volutpat. Curabitur commodo turpis ut arcu dignissim vitae rhoncus sapien auctor. Nam auctor hendrerit turpis, nec malesuada diam dignissim vitae. Vestibulum pharetra, enim sit amet elementum eleifend, augue libero porttitor sapien, eget porta magna magna sed sem. Suspendisse nec ligula mauris. ');
$c->addValue('values', array(1,2,3,4));
$c->addValue('names', array('Gregorio', 'Osvaldo', 'Ermenegilda', 'Esmeraldo'));
$c->addValue('users', array(
	array('name' => 'bob', 'phone' => '555-3425'),
	array('name' => 'jim', 'phone' => '555-4364'),
	array('name' => 'joe', 'phone' => '555-3422'),
	array('name' => 'jerry', 'phone' => '555-4973'),
	array('name' => 'fred', 'phone' => '555-3235')
	));
$c->addValue($array1, $array2);
$c->renderize('example.tpl');
echo '<br /><hr /><p align="center">Debug (permetti i popup e ricarica la pagina)</p>';
$c->debug();
?>
