<?php
class ChiTiPensa extends User implements FrameworkPlugin {
	private $rendering = array();
	
	public function main($templateVarList) {
		$userList = parent::getUser();
		$nickname = ($userList) ? $userList[rand(0, parent::countUser()-1)]->nickname : '';
		$chitipensa = ($nickname !== '') ? '<a href="'.$this->config[0]->url_index.'/profile/'.$nickname.'.html">'.$nickname.'</a>!' : 'Nessuno! Qui non c\'è anima viva D:';
		$this->rendering['postmenu'] = $templateVarList['postmenu'].'<div align="center">L\'utente fortunato di oggi è... '.$chitipensa.'</div>';
		return $this->rendering;
	}
}
