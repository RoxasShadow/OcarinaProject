<?php
/**
	core/class.Rendering.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Configuration.php');

/* Questa classe mette a disposizione dei metodi per interagire con il motore di rendering. */
class Rendering extends Configuration {
	private $smarty = NULL;
	public $skin = NULL;
	private $time_start = NULL;
	
	/* Quando la classe viene istanziata, il costruttore provvede a creare un nuovo oggetto Smarty. */
	public function __construct() {
		parent::__construct(); // Eredito il costruttore della superclasse
		$this->time_start = $this->microtime_float(); // Il timer lo avvio qui poichè la classe viene istanziata ad ogni script.
		require_once(parent::$this->config[0]->root_rendering.'/Smarty.class.php');
		$this->smarty = new Smarty;
		$path = $this->config[0]->root_rendering;
		$this->smarty->cache_dir = $path.'/cache';
		$this->smarty->template_dir = $path.'/templates';
		$this->smarty->compile_dir = $path.'/templates_c';
		$this->smarty->config_dir = $path.'/configs';
		$this->smarty->error_reporting = E_ALL | E_STRICT; // Mostra tutti i tipi di errore
		$this->smarty->allow_php_tag = true; // Serve per leggere il numero di commenti di ogni news dalla index :(
		$this->smarty->force_compile = false; // Permette di non recompilare ogni volta il template
		$this->smarty->loadFilter('output', 'trimwhitespace'); // Plugin che comprime l'HTML velocizzando la renderizzazione da parte del browser
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
		$this->addValue('url', $this->config[0]->url);
		$this->addValue('root', $this->config[0]->root);
		$this->addValue('url_index', $this->config[0]->url_index);
		$this->addValue('root_index', $this->config[0]->root_index);
		$this->addValue('url_admin', $this->config[0]->url_admin);
		$this->addValue('root_admin', $this->config[0]->root_admin);
		$this->addValue('url_rendering', $this->config[0]->url_rendering);
		$this->addValue('root_rendering', $this->config[0]->root_rendering);
		$this->addValue('url_immagini', $this->config[0]->url_immagini);
		$this->addValue('root_immagini', $this->config[0]->root_immagini);
		$this->addValue('nomesito', $this->config[0]->nomesito);
		$this->addValue('skin', $this->skin);
		$this->addValue('query', $this->numQuery);
		$this->addValue('time', $this->microtime_float() - $this->time_start);
		
		$this->smarty->templateExists($this->skin.'/'.$filename) ? $this->smarty->display($this->skin.'/'.$filename) : false;
	}

	/* Visualizza le skin attualmente presenti. */
	public function getSkinList() {
		$dir = $this->config[0]->root_rendering.'/templates/';
		$apri = opendir($dir);
		$f = array();
		while($skin = readdir($apri))
			if(($skin !== '.') && ($skin !== '..') && ($skin !== 'admin') && (is_dir($dir.$skin)))
				$f[] = $skin;
		return $f;
	}
}
