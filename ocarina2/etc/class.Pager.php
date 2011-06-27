<?php
/**
	/etc/class.Pager.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di creare un navigatore per le news. */
class Pager extends News {
	public $totale, $max, $currentPage, $numPages, $min = NULL;
	
	public function __construct($max) {
		parent::__construct();
		$this->totale = parent::countNews();
		$this->max = $max;
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
		$nav = array();
		for($i=1; $i<=$this->numPages; ++$i)
			$nav[$i] = $i;
		return $nav;
	}
}
