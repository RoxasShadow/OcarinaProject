<?php
class Hello implements FrameworkPlugin {
	/* Ok, that is not an hello world, but is very cool, isn't it? :D */
	private $rendering = array();
	
	public function main($templateVarList) {
		$this->rendering['footer'] = '<p align="right"><sarcasm>Proudly</sarcasm> running on <b><a href="http://www.giovannicapuano.net">Ocarina2 CMS</a></b>.</p>';
		return $this->rendering;
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
