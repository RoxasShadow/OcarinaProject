<?php
class ChiTiPensa extends User implements FrameworkPlugin {
	private $rendering = array();
	
	public function main() {
		$userList = parent::getUser();
		$this->rendering['luckyuser'] = ($userList) ? $userList[rand(0, parent::countUser()-1)]->nickname : 'Nessuno! Qui non c\'è anima viva D:';
		return $this->rendering;
	}
}
