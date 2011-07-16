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
		11: Comments blocked
		12: Comment not sended
		13: Comment sended
		14: Comment sended and waiting for approvation
		15: The registration require the validation via email
		16: String too long/short
	JSON request (GET):
		news()
		news($minititoloNews)
		countnews()
		searchnews($contenuto)
		votenews($minititoloNews)
		comment()
		comment($id)
		comment($minititoloNews)
		searchcomment($contenuto)
		createcomment($titolo, $contenuto, $nickname)
		mycomment($nickname)
		page()
		page($minititoloPagina)
		countpage()
		votepage($minititoloPagina)
		searchpage($contenuto)
		user()
		user($nickname)
		countuser()
		countaccess()
		registration($nickname, $password, $email)
		login($nickname, $password)
		logout()
		islogged()
		nickname()
		useronline()
		visitatoronline()
*/
require_once('core/class.Comments.php');
require_once('core/class.Page.php');
require_once('core/class.User.php');
$comment = new Comments();
$pagina = new Page();
$user = new User();
$action = isset($_GET['action']) ? $comment->purge($_GET['action']) : '';
$titolo = isset($_GET['title']) ? $comment->purge($_GET['title']) : '';
$nickname = isset($_GET['nickname']) ? $comment->purge($_GET['nickname']) : '';
$password = isset($_GET['password']) ? $comment->purge($_GET['password']) : '';
$email = isset($_GET['email']) ? $comment->purge($_GET['email']) : '';
$contenuto = isset($_GET['content']) ? $comment->purge($_GET['content']) : '';
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';
$actionPermitted = array(
	'news',
	'countnews',
	'searchnews',
	'votenews'
	'comment',
	'searchcomment',
	'createcomment',
	'mycomment',
	'page',
	'countpage',
	'votepage'
	'searchpage',
	'user',
	'countuser',
	'countaccess',
	'login',
	'logout',
	'islogged',
	'nickname',
	'useronline',
	'visitatoronline'
);

if(($action == 'news') && ($titolo !== '')) {
	if(!$comment = $comment->getNews($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($comment[0]->id).',';
				echo '"author":'.json_encode($comment[0]->autore).',';
				echo '"title":'.json_encode($comment[0]->titolo).',';
				echo '"minititle":'.json_encode($comment[0]->minititolo).',';
				echo '"content":'.json_encode($comment[0]->contenuto).',';
				echo '"category":'.json_encode($comment[0]->categoria).',';
				echo '"date":'.json_encode($comment[0]->data).',';
				echo '"hour":'.json_encode($comment[0]->ora).',';
				echo '"lastmoddate":'.json_encode($comment[0]->dataultimamodifica).',';
				echo '"lastmodhour":'.json_encode($comment[0]->oraultimamodifica).',';
				echo '"lastmodauthor":'.json_encode($comment[0]->autoreultimamodifica).',';
				echo '"visits":'.json_encode($comment[0]->visite).',';
				echo '"votes":'.json_encode($comment[0]->voti);
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
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"title":'.json_encode($v->titolo).',';
				$json .= '"minititle":'.json_encode($v->minititolo).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"category":'.json_encode($v->categoria).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora).',';
				$json .= '"lastmoddate":'.json_encode($v->dataultimamodifica).',';
				$json .= '"lastmodhour":'.json_encode($v->oraultimamodifica).',';
				$json .= '"lastmodauthor":'.json_encode($v->autoreultimamodifica).',';
				$json .= '"visits":'.json_encode($v->visite).',';
				$json .= '"votes":'.json_encode($v->voti);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif($action == 'countnews') {
	echo '{"response":'.json_encode($comment->countNews()).'}';
}
elseif(($action == 'searchnews') && ($contenuto !== '')) {
	if(!$comment = $comment->searchNews($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"title":'.json_encode($v->titolo).',';
				$json .= '"minititle":'.json_encode($v->minititolo).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"category":'.json_encode($v->categoria).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora).',';
				$json .= '"lastmoddate":'.json_encode($v->dataultimamodifica).',';
				$json .= '"lastmodhour":'.json_encode($v->oraultimamodifica).',';
				$json .= '"lastmodauthor":'.json_encode($v->autoreultimamodifica).',';
				$json .= '"visits":'.json_encode($v->visite).',';
				$json .= '"votes":'.json_encode($v->voti);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'votenews') && ($titolo !== '')) {
	if(!$comment->isLogged())
		echo '{"response":"2"}';
	elseif(!$comment->voteNews($titolo))
		echo '{"response":"1"}';
	else
		echo '{"response":"9"}';
}
elseif(($action == 'comment') && ($titolo == '') && ($id == '')) {
	if(!$comment = $comment->getComment())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora);
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
				echo '"author":'.json_encode($comment[0]->autore).',';
				echo '"content":'.json_encode($comment[0]->contenuto).',';
				echo '"news":'.json_encode($comment[0]->news).',';
				echo '"date":'.json_encode($comment[0]->data).',';
				echo '"hour":'.json_encode($comment[0]->ora);
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
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'searchcomment') && ($contenuto !== '')) {
	if(!$comment = $comment->searchComment($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'createcomment') && ($titolo !== '') && ($contenuto !== '') && ($nickname !== '')) {
	if($user->isLogged()) {
		$array = ($comment->config[0]->approvacommenti == 0) ? array($nickname, $contenuto, $titolo, date('d-m-y'), date('G:m:s'), 1) : array($nickname, $contenuto, $titolo, date('d-m-y'), date('G:m:s'), 0);
		if($comment->config[0]->commenti == 0)
			echo '{"response":"11"}';
		elseif($comment->createComment($array)) {
			if($comment->config[0]->log == 1)
				$comment->log($nickname, 'Comment sended.');
			echo ($comment->config[0]->approvacommenti == 0) ? '{"response":"13"}' : '{"response":"14"}';
		}
		else {
			if($comment->config[0]->log == 1)
				$comment->log($nickname, 'Comment was not sended.');
			echo '{"response":"12"}';
		}
	}
	else
		echo '{"response":"2"}';
}
elseif(($action == 'mycomment') && ($nickname !== '')) {
	if(!$comment = $comment->searchCommentByUser($nickname))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($comment as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"news":'.json_encode($v->news).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'countcomment') && ($titolo !== '')) {
	echo '{"response":'.json_encode($comment->countCommentByNews($titolo)).'}';
}
elseif(($action == 'page') && ($titolo !== '')) {
	if(!$pagina = $pagina->getPage($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($pagina[0]->id).',';
				echo '"author":'.json_encode($pagina[0]->autore).',';
				echo '"title":'.json_encode($pagina[0]->titolo).',';
				echo '"minititle":'.json_encode($pagina[0]->minititolo).',';
				echo '"content":'.json_encode($pagina[0]->contenuto).',';
				echo '"category":'.json_encode($pagina[0]->categoria).',';
				echo '"date":'.json_encode($pagina[0]->data).',';
				echo '"hour":'.json_encode($pagina[0]->ora).',';
				echo '"lastmoddate":'.json_encode($pagina[0]->dataultimamodifica).',';
				echo '"lastmodhour":'.json_encode($pagina[0]->oraultimamodifica).',';
				echo '"lastmodauthor":'.json_encode($pagina[0]->autoreultimamodifica).',';
				echo '"visits":'.json_encode($pagina[0]->visite).',';
				echo '"votes":'.json_encode($pagina[0]->voti);				
			echo '}';
		echo '}';
	}
}
elseif(($action == 'page') && ($titolo == '')) {
	if(!$pagina = $pagina->getPage())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($pagina as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"title":'.json_encode($v->titolo).',';
				$json .= '"minititle":'.json_encode($v->minititolo).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"category":'.json_encode($v->categoria).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora).',';
				$json .= '"lastmoddate":'.json_encode($v->dataultimamodifica).',';
				$json .= '"lastmodhour":'.json_encode($v->oraultimamodifica).',';
				$json .= '"lastmodauthor":'.json_encode($v->autoreultimamodifica).',';
				$json .= '"visits":'.json_encode($v->visite).',';
				$json .= '"votes":'.json_encode($v->voti);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif($action == 'countpage') {
	echo '{"response":'.json_encode($pagina->countPage()).'}';
}
elseif(($action == 'searchpage') && ($contenuto !== '')) {
	if(!$pagina = $pagina->searchPage($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($pagina as $v) {
			$json .= '{';
				$json .= '"id":'.json_encode($v->id).',';
				$json .= '"author":'.json_encode($v->autore).',';
				$json .= '"title":'.json_encode($v->titolo).',';
				$json .= '"minititle":'.json_encode($v->minititolo).',';
				$json .= '"content":'.json_encode($v->contenuto).',';
				$json .= '"category":'.json_encode($v->categoria).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora).',';
				$json .= '"lastmoddate":'.json_encode($v->dataultimamodifica).',';
				$json .= '"lastmodhour":'.json_encode($v->oraultimamodifica).',';
				$json .= '"lastmodauthor":'.json_encode($v->autoreultimamodifica).',';
				$json .= '"visits":'.json_encode($v->visite).',';
				$json .= '"votes":'.json_encode($v->voti);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif(($action == 'votepage') && ($titolo !== '')) {
	if(!$pagina->isLogged())
		echo '{"response":"2"}';
	elseif(!$pagina->votePage($titolo))
		echo '{"response":"1"}';
	else
		echo '{"response":"9"}';
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
				echo '"grade":'.json_encode($user[0]->grado).',';
				echo '"date":'.json_encode($user[0]->data).',';
				echo '"hour":'.json_encode($user[0]->ora).',';
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
				$json .= '"grade":'.json_encode($v->grado).',';
				$json .= '"date":'.json_encode($v->data).',';
				$json .= '"hour":'.json_encode($v->ora).',';
				$json .= '"bio":'.json_encode($v->bio).',';
				$json .= '"avatar":'.json_encode($v->avatar);
			$json .= '},';
		}
	 	echo trim($json, ',').']}';
	}
}
elseif($action == 'countuser') {
	echo '{"response":'.json_encode($user->countUser()).'}';
}
elseif($action == 'countaccess') {
	echo '{"response":'.json_encode($user->config[0]->totalevisitatori).'}';
}
elseif(($action == 'registration') && ($nickname !== '') && ($password !== '') && ($email !== '')) {
	if($user->isLogged())
		echo '{"response":"2"}';
	if(((strlen($password) > 4)) || (strlen($nickname) > 4)) {
		if($user->config[0]->validazioneaccount == 1) {
			$codice = $user->getCode(); // Validazione account
			$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), $codice, $user->config[0]->skin);
			if($user->createUser($array)) {
				$user->sendMail($email, $user->config[0]->nomesito.' @ Validazione account per '.$nickname.'.', 'Ciao '.$nickname.',
									dal momento che ti sei registrato, il sistema ha bisogno di essere sicuro che la tua email sia valida.
									Per validarla ti basta cliccare il seguente link: '.$user->config[0]->url_index.'/registrazione.php?codice='.$codice.'

									Se non sei tu '.$nickname.', ignora questa email.

									Il webmaster di '.$user->config[0]->nomesito.'.');
				echo '{"response":"15"}';
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registrated via API.');	
			}
			else {
				echo '{"response":"6"}';
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registrated via API failed.');	
			}
		}
		else {
			$array = array($nickname, $password, $email, 6, date('d-m-y'), date('G:m:s'), '', $user->config[0]->skin);
			if($user->createUser($array)) {
				echo '{"response":"9"}';
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registrated via API.');
			}
			else {
				echo '{"response":"6"}';
				if($user->config[0]->log == 1)
					$user->log($nickname, 'Registration via API failed.');
			}
		}
	}
	else
		echo '{"response":"16"}';
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
elseif($action == 'useronline') {
	$useronline = $user->getUserOnline();
	$json = '{"response": [';
	for($i=0, $count=count($useronline); $i<$count; ++$i) {
		$json .= '{';
			$json .= '"nickname":'.json_encode($useronline[$i]);
		$json .= '},';
	}
	echo trim($json, ',').']}';
}
elseif($action == 'visitatoronline') {
	echo '{"response":'.json_encode($user->getVisitatorOnline()).'}';
}
else {
	$found = 0;
	for($i=0, $count=count($actionPermitted); $i<$count; ++$i)
		if($action == $actionPermitted[$i])
			++$found;
	if($found == 0)
		echo '{"response":"8"}';
	else
		echo '{"response":"7"}';
}
