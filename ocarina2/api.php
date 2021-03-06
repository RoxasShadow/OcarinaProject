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
		12: Comment not sent
		13: Comment sent
		14: Comment sent and waiting for approvation
		15: The registration require the validation via email
		16: String too long/short
	JSON request (GET):
		news()
		news($minititoloNews)
		lastnews()
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
		countpm()
		registration($nickname, $password, $email)
		login($nickname, $password)
		logout()
		islogged()
		nickname()
		useronline()
		visitatoronline()
*/
require_once('core/class.Ocarina.php');
$ocarina = new Ocarina();
$action = isset($_GET['action']) ? $ocarina->purge($_GET['action']) : '';
$titolo = isset($_GET['title']) ? $ocarina->purge($_GET['title']) : '';
$nickname = isset($_GET['nickname']) ? $ocarina->purge($_GET['nickname']) : '';
$password = isset($_GET['password']) ? $ocarina->purge($_GET['password']) : '';
$email = isset($_GET['email']) ? $ocarina->purge($_GET['email']) : '';
$contenuto = isset($_GET['content']) ? $ocarina->purge($_GET['content']) : '';
$id = ((isset($_GET['id'])) && is_numeric($_GET['id'])) ? (int)$_GET['id'] : '';
$actionPermitted = array(
	'news',
	'lastnews',
	'countnews',
	'searchnews',
	'votenews',
	'comment',
	'searchcomment',
	'createcomment',
	'mycomment',
	'page',
	'countpage',
	'votepage',
	'searchpage',
	'user',
	'countuser',
	'countaccess',
	'countpm',
	'login',
	'logout',
	'islogged',
	'nickname',
	'useronline',
	'visitatoronline'
);

if(($action == 'news') && ($titolo !== '')) {
	if(!$ocarina = $ocarina->getNews($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($ocarina[0]->id).',';
				echo '"author":'.json_encode($ocarina[0]->autore).',';
				echo '"title":'.json_encode($ocarina[0]->titolo).',';
				echo '"minititle":'.json_encode($ocarina[0]->minititolo).',';
				echo '"content":'.json_encode($ocarina[0]->contenuto).',';
				echo '"category":'.json_encode($ocarina[0]->categoria).',';
				echo '"date":'.json_encode($ocarina[0]->data).',';
				echo '"hour":'.json_encode($ocarina[0]->ora).',';
				echo '"lastmoddate":'.json_encode($ocarina[0]->dataultimamodifica).',';
				echo '"lastmodhour":'.json_encode($ocarina[0]->oraultimamodifica).',';
				echo '"lastmodauthor":'.json_encode($ocarina[0]->autoreultimamodifica).',';
				echo '"visits":'.json_encode($ocarina[0]->visite).',';
				echo '"votes":'.json_encode($ocarina[0]->voti);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'news') && ($titolo == '')) {
	if(!$ocarina = $ocarina->getNews())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
elseif($action == 'lastnews') {
	if(!$ocarina = $ocarina->getNews('', 0, 10))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	echo '{"response":'.json_encode($ocarina->countNews()).'}';
}
elseif(($action == 'searchnews') && ($contenuto !== '')) {
	if(!$ocarina = $ocarina->searchNews($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	if(!$ocarina->isLogged())
		echo '{"response":"2"}';
	elseif(!$ocarina->voteNews($titolo))
		echo '{"response":"1"}';
	else
		echo '{"response":"9"}';
}
elseif(($action == 'comment') && ($titolo == '') && ($id == '')) {
	if(!$ocarina = $ocarina->getComment())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	if(!$ocarina = $ocarina->searchCommentById($id))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($ocarina[0]->id).',';
				echo '"author":'.json_encode($ocarina[0]->autore).',';
				echo '"content":'.json_encode($ocarina[0]->contenuto).',';
				echo '"news":'.json_encode($ocarina[0]->news).',';
				echo '"date":'.json_encode($ocarina[0]->data).',';
				echo '"hour":'.json_encode($ocarina[0]->ora);
			echo '}';
		echo '}';
	}
}
elseif(($action == 'comment') && ($titolo !== '')) {
	if(!$ocarina = $ocarina->getComment($titolo))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	if(!$ocarina = $ocarina->searchComment($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
		$array = ($ocarina->config[0]->approvacommenti == 0) ? array($nickname, $contenuto, $titolo, date('d-m-y'), date('G:m:s'), 1) : array($nickname, $contenuto, $titolo, date('d-m-y'), date('G:m:s'), 0);
		if($ocarina->config[0]->commenti == 0)
			echo '{"response":"11"}';
		elseif($ocarina->createComment($array)) {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($nickname, 'Comment sent.');
			echo ($ocarina->config[0]->approvacommenti == 0) ? '{"response":"13"}' : '{"response":"14"}';
		}
		else {
			if($ocarina->config[0]->log == 1)
				$ocarina->log($nickname, 'Comment was not sent.');
			echo '{"response":"12"}';
		}
	}
	else
		echo '{"response":"2"}';
}
elseif(($action == 'mycomment') && ($nickname !== '')) {
	if(!$ocarina = $ocarina->searchCommentByUser($nickname))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	echo '{"response":'.json_encode($ocarina->countCommentByNews($titolo)).'}';
}
elseif(($action == 'page') && ($titolo !== '')) {
	if(!$ocarina = $ocarina->getPage($titolo))
		echo '{"response":"1"}';
	else {
		echo '{';
			echo '"response": {';
				echo '"id":'.json_encode($ocarina[0]->id).',';
				echo '"author":'.json_encode($ocarina[0]->autore).',';
				echo '"title":'.json_encode($ocarina[0]->titolo).',';
				echo '"minititle":'.json_encode($ocarina[0]->minititolo).',';
				echo '"content":'.json_encode($ocarina[0]->contenuto).',';
				echo '"category":'.json_encode($ocarina[0]->categoria).',';
				echo '"date":'.json_encode($ocarina[0]->data).',';
				echo '"hour":'.json_encode($ocarina[0]->ora).',';
				echo '"lastmoddate":'.json_encode($ocarina[0]->dataultimamodifica).',';
				echo '"lastmodhour":'.json_encode($ocarina[0]->oraultimamodifica).',';
				echo '"lastmodauthor":'.json_encode($ocarina[0]->autoreultimamodifica).',';
				echo '"visits":'.json_encode($ocarina[0]->visite).',';
				echo '"votes":'.json_encode($ocarina[0]->voti);				
			echo '}';
		echo '}';
	}
}
elseif(($action == 'page') && ($titolo == '')) {
	if(!$ocarina = $ocarina->getPage())
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	echo '{"response":'.json_encode($ocarina->countPage()).'}';
}
elseif(($action == 'searchpage') && ($contenuto !== '')) {
	if(!$ocarina = $ocarina->searchPage($contenuto))
		echo '{"response":"1"}';
	else {
		$json = '{"response": [';
		foreach($ocarina as $v) {
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
	if(!$ocarina->isLogged())
		echo '{"response":"2"}';
	elseif(!$ocarina->votePage($titolo))
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
elseif($action == 'countpm') {
	require_once('core/class.PersonalMessage.php');
	$pm = new PersonalMessage();
	echo '{"response":'.json_encode($pm->countPM()).'}';
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
