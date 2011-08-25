<?php
class Traductor extends Configuration implements FrameworkPlugin {
	private $translator = NULL;
	
	public function __construct() {
		parent::__construct();
		require_once('class.Translator.php');
		$this->translator = new Translator();
	}
	
	public function __distruct() {
		parent::__distruct();
		unset($this->translator);
	}
	
	public function main($templateVarList) {		
		$rendering = array();
		if(isset($templateVarList['news'])) {
			for($i=0, $count=count($templateVarList['news']); $i<$count; ++$i)
				$templateVarList['news'][$i]->contenuto = $this->translate($templateVarList['news'][$i]->contenuto);
			$rendering['news'] = $templateVarList['news'];
		}
		if(isset($templateVarList['pagine'])) {
			for($i=0, $count=count($templateVarList['pagine']); $i<$count; ++$i)
				$templateVarList['pagine'][$i]->contenuto = $this->translate($templateVarList['pagine'][$i]->contenuto);
			$rendering['pagine'] = $templateVarList['pagine'];
		}
		if(isset($templateVarList['pagina'])) {
			for($i=0, $count=count($templateVarList['pagina']); $i<$count; ++$i)
				$templateVarList['pagina'][$i]->contenuto = $this->translate($templateVarList['pagina'][$i]->contenuto);
			$rendering['pagina'] = $templateVarList['pagina'];
		}
		if(isset($templateVarList['commenti'])) {
			for($i=0, $count=count($templateVarList['commenti']); $i<$count; ++$i)
				$templateVarList['commenti'][$i]->contenuto = $this->translate($templateVarList['commenti'][$i]->contenuto);
			$rendering['commenti'] = $templateVarList['commenti'];
		}
		if(isset($templateVarList['commento'])) {
			for($i=0, $count=count($templateVarList['commento']); $i<$count; ++$i)
				$templateVarList['commento'][$i]->contenuto = $this->translate($templateVarList['commento'][$i]->contenuto);
			$rendering['commento'] = $templateVarList['commento'];
		}
		return $rendering;
	}
	
	public function manipulate($type, $text) {
		return $this->translate($text);
	}
	
	private function translate($text) {
		$pattern = '/\[translate from\=(.*?) to\=(.*?)\](.*?)\[\/translate\]/is';
		$replace = $this->translator->translate('$3', '$1', '$2');
		return nl2br(preg_replace($pattern, $replace, $text));
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
