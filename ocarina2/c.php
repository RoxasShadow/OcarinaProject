<?php
include "core/class.Rendering.php";
$c = new Rendering();
$array1 = array("Nome", "Cognome");
$array2 = array("Giovanni", "capuano");
$c->addValue('titolo', 'Test page');
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
$c->renderize('index.tpl');
