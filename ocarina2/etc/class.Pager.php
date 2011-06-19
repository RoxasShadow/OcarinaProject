<?php
/**
	/etc/class.Pager.php
	(C) Giovanni Capuano 2011
*/
require_once(realpath(dirname("_FILE_")).'/core/class.News.php');

/* Questa classe permette di creare un navigatore per le news. */
class Pager extends News {
	private $totale, $max, $currentPage, $numPages, $min = NULL;
	
	public function __construct() {
		parent::__construct();
		$this->totale = parent::countNews();
		$config = parent::getConfig();
		$this->max = $config[0]->limitenews;
		$this->currentPage = ((!isset($_GET['p'])) || (isset($_GET['p']) && intval($_GET['p']) <= 1)) ? 1 : intval($_GET['p']);
		$this->numPages = ceil($this->totale / $this->max);
		$this->min = ($this->currentPage - 1) * $this->max;
	}
	
	public function __distruct() {
		parent::__distruct();
		unset($this->totale);
		unset($this->max);
		unset($this->currentPage);
		unset($this->numPages);
		unset($this->min);
	}
	
	public function getNav() {
		$this->nav = array();
		for($i=1; $i<=$this->numPages; $i++)
			$this->nav[$i] = $i;
		return $this->nav;
	}
	
	public function getCurrentPage() {
		return $this->currentPage;
	}
	
	public function getMin() {
		return $this->min;
	}
	
	public function getMax() {
		return $this->max;
	}
	public function getNumPages() {
		return $this->numPages;
	}
}
