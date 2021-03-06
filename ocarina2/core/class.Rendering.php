<?php
/**
	core/class.Rendering.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Page.php');

/* Questa classe mette a disposizione dei metodi per interagire con il motore di rendering. */
class Rendering extends Page {
	private $smarty = NULL;
	public $skin = NULL;
	private $time_start = NULL;
	
	/* Quando la classe viene istanziata, il costruttore provvede a creare un nuovo oggetto Smarty. */
	public function __construct() {
		parent::__construct(); // Eredito il costruttore della superclasse
		require_once($this->config[0]->root_rendering.'/Smarty.class.php');
		$this->time_start = $this->microtime_float(); // Il timer lo avvio qui poichè la classe viene istanziata ad ogni script.
		$this->smarty = new Smarty;
		
		$path = $this->config[0]->root_rendering;
		$this->smarty->cache_dir = $path.'/cache';
		$this->smarty->template_dir = $path.'/templates';
		$this->smarty->compile_dir = $path.'/templates_c';
		$this->smarty->config_dir = $path.'/configs';
		$this->smarty->error_reporting = E_ALL | E_STRICT; // 0 nasconde tutti gli errori. E_ALL | E_STRICT per mostrare tutti i tipi di errore
		$this->smarty->allow_php_tag = true; // Serve per leggere il numero di commenti di ogni news dalla index :(
		$this->smarty->force_compile = false; // Permette di non recompilare ogni volta il template
		$this->smarty->loadFilter('output', 'trimwhitespace'); // Plugin che comprime l'HTML velocizzando la renderizzazione da parte del browser
		/* Per i plugin. */
		$this->addValue('head', '');
		$this->addValue('body', '');
		$this->addValue('menu', '');
		$this->addValue('postmenu', '');
		$this->addValue('stats', '');
		$this->addValue('footer', '');
		
		/* Per tutto il resto :D */
		$this->addValue('versione', $this->config[0]->versione);
		$this->addValue('nomesito', $this->config[0]->nomesito);
		$this->addValue('url', $this->config[0]->url);
		$this->addValue('url_index', $this->config[0]->url_index);
		$this->addValue('url_admin', $this->config[0]->url_admin);
		$this->addValue('url_rendering', $this->config[0]->url_rendering);
		$this->addValue('url_immagini', $this->config[0]->url_immagini);
		$this->addValue('root', $this->config[0]->root);
		$this->addValue('root_index', $this->config[0]->root_index);
		$this->addValue('root_admin', $this->config[0]->root_admin);
		$this->addValue('root_rendering', $this->config[0]->root_rendering);
		$this->addValue('root_immagini', $this->config[0]->root_immagini);
		$this->addValue('time', $this->microtime_float() - $this->time_start);
		$this->addValue('utente', parent::isLogged() ? $this->username[0]->nickname : '');
		$this->addValue('grado', parent::isLogged() ? $this->username[0]->grado : '');
		$this->addValue('useronline', parent::getUserOnline());
		$this->addValue('visitatoronline', parent::getVisitatorOnline());
		$this->addValue('totaleaccessi', parent::getTotalVisits());
		$this->addValue('numQuery', $this->countQuery);
		$this->addValue('numCache', $this->countCache);
		$this->addValue('numeromp', parent::countPM());
		$this->addValue('countnews', parent::countNews());
		$this->addValue('countpages', parent::countPage());
		$this->addValue('countusers', parent::countUser());
		$user = parent::getLastUser();
		$this->addValue('lastuser', $user[0]->nickname);
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
		/* Attivazione plugin `first`. */
		require_once('class.Plugin.php');
		$bbcode = 0;
		if($this->config[0]->plugin == 1) {
			$plugins = Plugin::listPlugins();
			$varList = $this->getValues();
			foreach($plugins as $element)
				if((Plugin::getMetadata($element, 'enabled', '') == 'true') && (Plugin::getMetadata($element, 'working', '') == 'after') && (file_exists($this->config[0]->root_index.'/plugin/plugins/'.Plugin::getMetadata($element, 'path', ''))))
					try {
						$plugin = Plugin::loadPlugin($element);
						$output = $plugin->main($varList);
						if(is_array($output))
							foreach($output as $name => $value)
								if(($name !== '') && ($value !== ''))
									$this->addValue($name, $value);
						if($element == 'BBCode')
							$bbcode = 1;
					}
					catch(Exception $e) {
						if($ocarina->config[0]->log == 1)
							$ocarina->log($element, $e->getMessage());
						echo '<!-- '.$e->getMessage().' -->';
					}
			unset($plugins);
		}
		$this->addValue('bbcode', $bbcode);
		
		/* Renderizza il tutto con la skin appropriata. */
		require_once($this->config[0]->root_index.'/etc/mobile_device_detect.php');
		if($this->skin == 'admin') {
			if($filename == 'index.tpl') {
				$lastversion = json_decode(file_get_contents('http://www.giovannicapuano.net/ocarina/lastversion.php?w=ocarina2'));
				$this->addValue('lastversion', $lastversion->{'foo-bar'});
			}
			$this->addValue('skin','admin');
			$this->smarty->display('admin/'.$filename);
		}
		elseif((mobile_device_detect()) && ($this->skinExists('mobile'))) {
			$this->addValue('skin', 'mobile');
			$this->smarty->display('mobile'.'/'.$filename);
		}
		elseif($this->skinExists($this->skin)) {
			$this->addValue('skin', $this->skin);
			$this->smarty->display($this->skin.'/'.$filename);
		}
		else {
			$this->addValue('skin', $this->config[0]->skin);
			$this->smarty->display($this->config[0]->skin.'/'.$filename);
		}
	}

	/* Visualizza le skin attualmente presenti. */
	public function getSkinList($all = false) {
		$dir = $this->config[0]->root_rendering.'/templates/';
		$apri = opendir($dir);
		$f = array();
		while($skin = readdir($apri))
			if($all) {
				if(($skin !== '.') && ($skin !== '..') && (is_dir($dir.$skin)))
					$f[] = $skin;
			}
			else
				if(($skin !== '.') && ($skin !== '..') && ($skin !== 'admin') && ($skin !== 'mobile') && (is_dir($dir.$skin)))
					$f[] = $skin;
		closedir($apri);
		return $f;
	}

	/* Visualizza se la skin selezionata esiste. */
	public function skinExists($skin) {
		$skinList = $this->getSkinList(true);
		foreach($skinList as $v)
			if($v == $skin)
				return true;
		return false;
	}
	
	/* Installa una skin. */
	function installSkin($path, $FILES) {
		require_once($this->config[0]->root_index.'/etc/pclzip.lib.php');
		if((empty($FILES)) || (!is_array($FILES)))
			return false;
		do {
			/* Upload */
			if($_FILES['skin']['error'] == 0) {
				if($_FILES['skin']['type'] !== 'application/zip')
					return false;
				if(!copy($_FILES['skin']['tmp_name'], $path.$_FILES['skin']['name']))
					return false;
			}
			/* Unzip */
			$unzip = new PclZip($path.$_FILES['skin']['name']);
			if($unzip->extract(PCLZIP_OPT_PATH, $path) == 0)
				return false;
			/* Elimino l'archivio */
			if(file_exists($path.$_FILES['skin']['name']))
				unlink($path.$_FILES['skin']['name']);
		} while(false);
		return true;
	}
	
	/* Elimina una skin. */
	function deleteSkin($skin) {
		if(!is_dir($this->config[0]->root_rendering.'/templates/'.$skin.'/'))
			return false;
		return (parent::deleteDir($this->config[0]->root_rendering.'/templates/'.$skin.'/')) ? true : false;
	}
}
