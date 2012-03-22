<?php
/**
	core/interface.FrameworkPlugin.php
	(C) Giovanni Capuano 2011
*/

interface FrameworkPlugin {
	public function main($templateVarList);
	public function install();
	public function disinstall();
}
