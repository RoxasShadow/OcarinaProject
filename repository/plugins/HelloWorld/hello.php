<?php
/**
	/plugin/HelloWorld/hello.php
	(C) Giovanni Capuano 2011
*/
class Hello implements FrameworkPlugin {
	/* Ok, that is not an hello world, but is very cool, isn't it? :D */	
	public function main($templateVarList) {
		$rendering['footer'] = '<p align="right"><sarcasm>Proudly</sarcasm> running on <b><a href="http://www.giovannicapuano.net/ocarina/">Ocarina2 CMS</a></b>.</p>';
		return $rendering;
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
