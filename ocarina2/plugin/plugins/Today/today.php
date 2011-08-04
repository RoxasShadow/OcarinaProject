<?php
class Today extends Rendering implements FrameworkPlugin {
	public function __construct() {
		parent::__construct();
	}
	
	private function getDate() {
		return date('d-m-y');
	}
	
	public function main() {
		parent::addValue('data', $this->getDate());
		echo "<!-- I'm here, silenty, but i'm here O: -->\n";
	}
}
