<?php
/**
	/modificaprofilo.php
	(C) Giovanni Capuano 2011
*/
require_once('core/class.Ocarina.php');

$ocarina = new Ocarina();
$email = ((isset($_POST['email'])) && ($_POST['email'] !== '')) ? $ocarina->purge($_POST['email']) : '';
$skin = ((isset($_POST['skin'])) && ($_POST['skin'] !== '')) ? $ocarina->purge($_POST['skin']) : '';
$bio = ((isset($_POST['bio'])) && ($_POST['bio'] !== '')) ? $ocarina->purge($_POST['bio']) : '';
$avatar = ((isset($_POST['avatar'])) && ($_POST['avatar'] !== '')) ? $ocarina->purge($_POST['avatar']) : '';
$password = ((isset($_POST['password'])) && ($_POST['password'] !== '')) ? $ocarina->salt.$ocarina->purge($_POST['password']) : '';
$submit = isset($_POST['submit']) ? true : false;

$ocarina->skin = $ocarina->isLogged() ? $ocarina->username[0]->skin : $ocarina->config[0]->skin;
$ocarina->addValue('titolo', $ocarina->getLanguage('title', 6).$ocarina->getLanguage('title', 2).$ocarina->config[0]->nomesito);
$ocarina->addValue('description', $ocarina->getLanguage('description', 4));

if($ocarina->isLogged())
	if(!$submit) {
		$ocarina->addValue('email', $ocarina->username[0]->email);
		$ocarina->addValue('bio', $ocarina->username[0]->bio);
		$ocarina->addValue('avatar', $ocarina->username[0]->avatar);
		$ocarina->addValue('listaskin', $ocarina->getSkinList());
		$ocarina->addValue('skinattuale', $ocarina->skin);
	}
	else {
		if(($ocarina->isEmail($email)) && ($ocarina->isImage($avatar)) && ($email !== '') && ($bio !== '') && ($skin !== '') && ($avatar !== '') && ($password !== ''))
			if(($ocarina->isEmailUsed($ocarina->username[0]->nickname, $email)) || (md5($password) !== $ocarina->username[0]->password)) {
				if($ocarina->config[0]->log == 1)
						$ocarina->log($ocarina->username[0]->nickname, 'Profile modification failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('editprofile', 0));
			}
			elseif(($ocarina->editUser('email', $email, $ocarina->username[0]->nickname)) && ($ocarina->editUser('bio', $bio, $ocarina->username[0]->nickname)) && ($ocarina->editUser('skin', $skin, $ocarina->username[0]->nickname)) && ($ocarina->editUser('avatar', $avatar, $ocarina->username[0]->nickname))) {
				if($ocarina->config[0]->log == 1)
						$ocarina->log($ocarina->username[0]->nickname, 'Profile modificated.');
				$ocarina->addValue('result', $ocarina->getLanguage('editprofile', 1).header('Refresh: 2; URL='.$ocarina->config[0]->url_index.'/profile/'.$ocarina->username[0]->nickname.'.html'));
			}
			else {
				if($ocarina->config[0]->log == 1)
						$ocarina->log($ocarina->username[0]->nickname, 'Profile modification failed.');
				$ocarina->addValue('result', $ocarina->getLanguage('editprofile', 2));
			}
		else
			$ocarina->addValue('result', $ocarina->getLanguage('editprofile', 3));
	}
else
	$ocarina->addValue('result', $ocarina->getLanguage('editprofile', 4));
$ocarina->addValue('logged', $ocarina->isLogged());
$ocarina->addValue('submit', $submit);
(($ocarina->isLogged()) && ($ocarina->username[0]->grado == 7)) ? $ocarina->renderize('bannato.tpl') : $ocarina->renderize('modificaprofilo.tpl');
