<?php
class Hello implements FrameworkPlugin {
	private $rendering = array();
	
	public function main($templateVarList) {
		$this->rendering['nomesito'] = 'Hello, world!';
		return $this->rendering;
	}
}
