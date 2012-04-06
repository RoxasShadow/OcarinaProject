<?php
/**
	/plugin/CSRF/ManteinanceMode/manteinance.php
	(C) Giovanni Capuano 2011
*/
class Manteinance extends User implements FrameworkPlugin {
	public function main($templateVarList) {
		if((!parent::isLogged()) || ($this->username[0]->grado > 1)) { // Change this value if you want to change the permissions :)
			$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$rendering = array();
			$rendering['manteinance'] = ($language == 'it') ? $this->config[0]->nomesito.' è in manutenzione.' : $this->config[0]->nomesito.' is in manteinance.';
			die($rendering['manteinance']);
		}
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
