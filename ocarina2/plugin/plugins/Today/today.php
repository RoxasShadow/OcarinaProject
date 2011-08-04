<?php
class Today implements FrameworkPlugin {
	private $rendering = array();
	
	private function getDate() {
		return date('d-m-y');
	}
	
	public function main() {
		$this->rendering['data'] = $this->getDate();
		return $this->rendering;
	}
}
