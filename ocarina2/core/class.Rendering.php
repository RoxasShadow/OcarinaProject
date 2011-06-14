<?php
/**
	core/class.Rendering.php
	(C) Giovanni Capuano 2011
*/
include 'class.Configuration.php';
include '/var/www/htdocs/ocarina2/rendering/Smarty.class.php';

/* Questa classe mette a disposizione dei metodi per interagire con il motore di rendering. */
class Rendering extends Configuration {
	private $smarty = NULL;

	/* Quando la classe viene istanziata, il costruttore provvede a creare un nuovo oggetto Smarty. */
	public function __construct() {
		parent::__construct(); // Eredito il costruttore della superclasse
		$this->smarty = new Smarty;
		$getConfig = parent::getConfig();
		$path = $getConfig[0]->root_rendering;
		$this->smarty->cache_dir = $path.'/cache';
		$this->smarty->template_dir = $path.'/templates';
		$this->smarty->compile_dir = $path.'/templates_c';
		$this->smarty->config_dir = $path.'/configs';
		$this->smarty->error_reporting = E_ALL & ~E_NOTICE;
	}

	/* Quando la classe viene distrutta, il distruttore provvede a distruggere l'oggetto Smarty liberando memoria. */
	public function __distruct() {
		parent::__distruct(); // Eredito il distruttore della superclasse
		unset($this->smarty);
	}

	/* Aggiunge alle variabili del motore di rendering un array nome->valore, oppure semplicemente assegna le due rispettive stringhe.  */
	public function addValue($name, $value) {
		if((is_array($name)) && (is_array($value)) && (count($name) == count($value)))
			for($i=0, $count=count($name); $i<$count; $i++)
				$this->smarty->assign($name[$i], $value[$i]);
		else
			$this->smarty->assign($name, $value);
	}

	/* Rimuove tutte le variabili assegnate al motore di rendering. */
	public function resetValues() {
		$this->smarty->clearAllAssign();
	}

	/* Ritorna tutte le variabili assegnate al motore di rendering. */
	public function getValues() {
		return $this->smarty->getTemplateVars();
	}

	/* Effettua un controllo sulle directory, in particolare se esistono o hanno bisogno di permessi aggiuntivi. */
	public function debug() {
		$this->smarty->debugging = true;
		$this->smarty->testInstall();
		$getConfig = parent::getConfig();
		$this->smarty->debug_tpl = 'debug.tpl';
		$this->smarty->display('debug.tpl');
	}

	/* Il motore di rendering effettua il rendering del template in input e lo visualizza. */
	public function renderize($filename) {
		$getConfig = parent::getConfig();
		$this->smarty->templateExists($getConfig[0]->skin.'/'.$filename) ? $this->smarty->display($getConfig[0]->skin.'/'.$filename) : false;
	}
}
