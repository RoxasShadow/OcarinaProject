<?php
class Hello implements FrameworkPlugin {
	private $rendering = array();
	
	public function main($templateVarList) {
		$this->rendering['footer'] = '<p align="center">Hello, world!</p>';
		return $this->rendering;
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
