<?php
class Hello implements FrameworkPlugin {
	private $rendering = array();
	
	public function main() {
		$this->rendering['hello'] = 'Hello, world!';
		return $this->rendering;
	}
}
