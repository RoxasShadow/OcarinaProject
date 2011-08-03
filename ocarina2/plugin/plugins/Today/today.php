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
	}
}
