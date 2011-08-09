<?php
class ChiTiPensa extends User implements FrameworkPlugin {
	private $rendering = array();
	
	private function getSentences() {
		$language = substr($this->purge($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2);
		$array = array();
		if($language == 'it') {
			$array['notfound'] = 'Nessuno! Qui non c\'è anima viva D:';
			$array['presentation'] = 'L\'utente fortunato di oggi è... ';
		}
		return $array;
	}
				
	public function main($templateVarList) {
		$language = $this->getSentences();
		$userList = parent::getUser();
		$nickname = ($userList) ? $userList[rand(0, parent::countUser()-1)]->nickname : '';
		$chitipensa = ($nickname !== '') ? '<a href="'.$this->config[0]->url_index.'/profile/'.$nickname.'.html">'.$nickname.'</a>!' : $language['notfound'];
		$this->rendering['postmenu'] = $templateVarList['postmenu'].'<div align="center">'.$language['presentation'].$chitipensa.'</div>';
		return $this->rendering;
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
