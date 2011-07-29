<?php
/**
	/modificaprofilo.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.User.php');
require_once('core/class.Rendering.php');

$user = new User();
$rendering = new Rendering();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $user->purge($_POST['email']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $user->purge($_POST['skin']) : '';
$bio = ((isset($_POST['bio'])) && ($_POST['bio'] !== '')) ? $user->purge($_POST['bio']) : '';
$avatar = ((isset($_POST['avatar'])) && ($_POST['avatar'] !== '')) ? $user->purge($_POST['avatar']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $user->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$rendering->addValue('utente', $user->isLogged() ? $user->username[0]->nickname : '');
$rendering->skin = $user->isLogged() ? $user->username[0]->skin : $user->config[0]->skin;
$rendering->addValue('titolo', $user->getLanguage('title', 6).$user->getLanguage('title', 2).$user->config[0]->nomesito);
$rendering->addValue('description', $user->getLanguage('description', 4));
$rendering->addValue('useronline', $user->getUserOnline());
$rendering->addValue('visitatoronline', $user->getVisitatorOnline());
$rendering->addValue('totaleaccessi', $user->getTotalVisits());
require_once('core/class.PersonalMessage.php');
$pm = new PersonalMessage();
$rendering->addValue('numeromp', $pm->countPM());
unset($pm);

if($user->isLogged())
	if(!$submit) {
		$rendering->addValue('email', $user->username[0]->email);
		$rendering->addValue('bio', $user->username[0]->bio);
		$rendering->addValue('avatar', $user->username[0]->avatar);
		$rendering->addValue('listaskin', $rendering->getSkinList());
		$rendering->addValue('skinattuale', $rendering->skin);
	}
	else {
		if(($user->isEmail($email)) && ($user->isImage($avatar)) && ($email !== '') && ($bio !== '') && ($skin !== '') && ($avatar !== '') && ($password !== ''))
			if(($user->isEmailUsed($user->username[0]->nickname, $email)) || (md5($password) !== $user->username[0]->password)) {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modification failed.');
				$rendering->addValue('result', $user->getLanguage('editprofile', 0));
			}
			elseif(($user->editUser('email', $email, $user->username[0]->nickname)) && ($user->editUser('bio', $bio, $user->username[0]->nickname)) && ($user->editUser('skin', $skin, $user->username[0]->nickname)) && ($user->editUser('avatar', $avatar, $user->username[0]->nickname))) {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modificated.');
				$rendering->addValue('result', $user->getLanguage('editprofile', 1).header('Refresh: 2; URL='.$user->config[0]->url_index.'/profile/'.$user->username[0]->nickname.'.html'));
			}
			else {
				if($user->config[0]->log == 1)
						$user->log($user->username[0]->nickname, 'Profile modification failed.');
				$rendering->addValue('result', $user->getLanguage('editprofile', 2));
			}
		else
			$rendering->addValue('result', $user->getLanguage('editprofile', 3));
	}
else
	$rendering->addValue('result', $user->getLanguage('editprofile', 4));
$rendering->addValue('logged', $user->isLogged());
$rendering->addValue('submit', $submit);
(($user->isLogged()) && ($user->username[0]->grado == 7)) ? $rendering->renderize('bannato.tpl') : $rendering->renderize('modificaprofilo.tpl');
