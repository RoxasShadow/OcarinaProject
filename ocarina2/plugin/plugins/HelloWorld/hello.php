<?php
class Hello extends Rendering implements FrameworkPlugin {
	public function main() {
		parent::addValue('nomesito', 'LOLMAO');
		echo "<!-- I'm here, silenty, but i'm here O: -->\n";
	}
}
