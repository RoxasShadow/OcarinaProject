<?php
/**
	/plugin/CSRF/ChiTiPensa/chitipensa.php
	(C) Giovanni Capuano 2011
*/
class ChiTiPensa extends User implements FrameworkPlugin {
	private function getSentences() {
		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$array = array();
		if($language == 'it') {
			$array['notfound'] = 'Nessuno! Qui non c\'è anima viva D:';
			$array['presentation'] = 'In questo momento ti sta pensando molto intensamente... ';
		}
		else {
			$array['notfound'] = 'Nobody! There is not a soul here D:';
			$array['presentation'] = 'Right now thinking you very deeply...';
		}
		return $array;
	}
				
	public function main($templateVarList) {
		$rendering = array();
		$language = $this->getSentences();
		$userList = parent::getUser();
		$nickname = ($userList) ? $userList[rand(0, parent::countUser()-1)]->nickname : '';
		$chitipensa = ($nickname !== '') ? '<a href="'.$this->config[0]->url_index.'/profile/'.$nickname.'.html">'.$nickname.'</a>!' : $language['notfound'];
		$rendering['postmenu'] = $templateVarList['postmenu'].'<div align="center">'.$language['presentation'].$chitipensa.'</div>';
		return $rendering;
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
