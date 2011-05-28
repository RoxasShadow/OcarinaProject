<?php
require_once('class.User.php');
$php = new User();

/*foreach($php->getUser() as $v)
	echo $v->nickname;*/

$php->editUser('nickname', 'Roxas Shadow', 'Rox');

?>
