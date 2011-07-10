<?php
/**
	/api.php
	(C) Giovanni Capuano 2011
*/
/*
	JSON response:
		1: Content not found
		2: Action denied
		3: Login failed
		4: Logged in
		5: Logged out
		6: Undefined error
		7: Error request
		8: Action not found
		9: Yes
		10: Not
	JSON request (GET):
		news()
		news($minititoloNews)
		comment()
		comment($id)
		comment($minititoloNews)
		mycomment($nickname)
		pagina()
		pagina($minititoloPagina)
		user()
		user($nickname)
		login($nickname, $password)
		logout()
		islogged()
		nickname()
*/
require_once('core/class.Comments.php');
require_once('core/class.Page.php');
require_once('core/class.User.php');
$comment = new Comments();
$pagina = new Page();
$user = new User();
$action = isset($_GET['action']) ? $comment->purge($_GET['action']) : '';
$titolo = isset($_GET['titolo']) ? $comment->purge($_GET['titolo']) : '';
$nickname = isset($_GET['nickname']) ? $comment->purge($_GET['nickname']) : '';
$password = isset($_GET['password']) ? $comment->purge($_GET['password']) : '';
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';

if(($action == 'news') && ($titolo !== '')) {
	if(!$comment = $comment->getNews($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($comment[0]->id).',';
				echo '"autore":'.json_encode($comment[0]->autore).',';
				echo '"titolo":'.json_encode($comment[0]->titolo).',';
				echo '"minititolo":'.json_encode($comment[0]->minititolo).',';
				echo '"contenuto":'.json_encode($comment[0]->contenuto).',';
				echo '"categoria":'.json_encode($comment[0]->categoria).',';
				echo '"data":'.json_encode($comment[0]->data).',';
				echo '"ora":'.json_encode($comment[0]->ora).',';
				echo '"dataultimamodifica":'.json_encode($comment[0]->dataultimamodifica).',';
				echo '"oraultimamodifica":'.json_encode($comment[0]->oraultimamodifica).',';
				echo '"autoreultimamodifica":'.json_encode($comment[0]->autoreultimamodifica);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'news') && ($titolo == '')) {
	if(!$comment = $comment->getNews())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"autore":'.json_encode($v->autore).',';
				$json .= '"titolo":'.json_encode($v->titolo).',';
				$json .= '"minititolo":'.json_encode($v->minititolo).',';
				$json .= '"contenuto":'.json_encode($v->contenuto).',';
				$json .= '"categoria":'.json_encode($v->categoria).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora).',';
				$json .= '"dataultimamodifica":'.json_encode($v->dataultimamodifica).',';
				$json .= '"oraultimamodifica":'.json_encode($v->oraultimamodifica).',';
				$json .= '"autoreultimamodifica":'.json_encode($v->autoreultimamodifica);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'comment') && ($titolo == '') && ($id == '')) {
	if(!$comment = $comment->getComment())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"autore":'.json_encode($v->autore).',';
				$json .= '"contenuto":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'comment') && ($id !== '')) {
	if(!$comment = $comment->searchCommentById($id))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($comment[0]->id).',';
				echo '"autore":'.json_encode($comment[0]->autore).',';
				echo '"contenuto":'.json_encode($comment[0]->contenuto).',';
				echo '"news":'.json_encode($comment[0]->news).',';
				echo '"data":'.json_encode($comment[0]->data).',';
				echo '"ora":'.json_encode($comment[0]->ora);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'comment') && ($titolo !== '')) {
	if(!$comment = $comment->getComment($titolo))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"autore":'.json_encode($v->autore).',';
				$json .= '"contenuto":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'mycomment') && ($nickname !== '')) {
	if(!$comment = $comment->searchCommentByUser($nickname))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"autore":'.json_encode($v->autore).',';
				$json .= '"contenuto":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'countcomment') && ($titolo !== '')) {
	echo '{"response":'.json_encode($comment->countCommentByNews($titolo)).'}';
}
elseif(($action == 'pagina') && ($titolo !== '')) {
	if(!$pagina = $pagina->getPage($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($pagina[0]->id).',';
				echo '"autore":'.json_encode($pagina[0]->autore).',';
				echo '"titolo":'.json_encode($pagina[0]->titolo).',';
				echo '"minititolo":'.json_encode($pagina[0]->minititolo).',';
				echo '"contenuto":'.json_encode($pagina[0]->contenuto).',';
				echo '"categoria":'.json_encode($pagina[0]->categoria).',';
				echo '"data":'.json_encode($pagina[0]->data).',';
				echo '"ora":'.json_encode($pagina[0]->ora).',';
				echo '"dataultimamodifica":'.json_encode($pagina[0]->dataultimamodifica).',';
				echo '"oraultimamodifica":'.json_encode($pagina[0]->oraultimamodifica).',';
				echo '"autoreultimamodifica":'.json_encode($pagina[0]->autoreultimamodifica);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'pagina') && ($titolo == '')) {
	if(!$pagina = $pagina->getPage())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($pagina as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"autore":'.json_encode($v->autore).',';
				$json .= '"titolo":'.json_encode($v->titolo).',';
				$json .= '"minititolo":'.json_encode($v->minititolo).',';
				$json .= '"contenuto":'.json_encode($v->contenuto).',';
				$json .= '"categoria":'.json_encode($v->categoria).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora).',';
				$json .= '"dataultimamodifica":'.json_encode($v->dataultimamodifica).',';
				$json .= '"oraultimamodifica":'.json_encode($v->oraultimamodifica).',';
				$json .= '"autoreultimamodifica":'.json_encode($v->autoreultimamodifica);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'user') && ($nickname !== '')) {
	if(!$user = $user->getUser($nickname))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($user[0]->id).',';
				echo '"nickname":'.json_encode($user[0]->nickname).',';
				echo '"email":'.json_encode($user[0]->email).',';
				echo '"grado":'.json_encode($user[0]->grado).',';
				echo '"data":'.json_encode($user[0]->data).',';
				echo '"ora":'.json_encode($user[0]->ora).',';
				echo '"bio":'.json_encode($user[0]->bio).',';
				echo '"avatar":'.json_encode($user[0]->avatar);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'user') && ($nickname == '')) {
	if(!$user = $user->getUser())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($user as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"nickname":'.json_encode($v->nickname).',';
				$json .= '"email":'.json_encode($v->email).',';
				$json .= '"grado":'.json_encode($v->grado).',';
				$json .= '"data":'.json_encode($v->data).',';
				$json .= '"ora":'.json_encode($v->ora).',';
				$json .= '"bio":'.json_encode($v->bio).',';
				$json .= '"avatar":'.json_encode($v->avatar);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'login') && ($nickname !== '') && ($password !== '')) {
	if($user->login($nickname, $password)) {
		if($user->config[0]->log == 1)
			$user->log($nickname, 'Logged in by API.');
		echo '{"response":"4"}';
	}
	else {
		if($user->config[0]->log == 1)
			$user->log($nickname, 'Login failed by API.');
		echo '{"response":"3"}';
	}	
}
elseif($action == 'logout') {
	if($user->isLogged())
		$user->logout();
	if($user->isLogged())
		echo '{"response":"6"}';
	else
		echo '{"response":"5"}';
		
}
elseif($action == 'islogged') {
	if($user->isLogged())
		echo '{"response":"9"}';
	else
		echo '{"response":"10"}';	
}
elseif($action == 'nickname') {
	if($user->isLogged())
		echo '{"response":'.json_encode($user->username[0]->nickname).'}';
	else
		echo '{"response":"2"}';	
}
else
	echo '{"response":"8"}';