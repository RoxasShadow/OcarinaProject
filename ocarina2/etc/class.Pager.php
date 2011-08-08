<?php
/**
	/etc/class.Pager.php
	(C) Giovanni Capuano 2011

/* Questa classe permette di creare un navigatore per le pagine. */
class Pager {
	public $totale, $max, $currentPage, $numPages, $min = NULL;
	
	public function __construct($count, $max) {
		$this->totale = $count;
		$this->max = $max;
		$this->currentPage = ((!isset($_GET['p'])) || (isset($_GET['p']) && intval($_GET['p']) <= 1)) ? 1 : intval($_GET['p']);
		$this->numPages = ceil($this->totale / $this->max);
		$this->min = ($this->currentPage - 1) * $this->max;
	}
	
	public function getNav() {
		$nav = array();
		for($i=1; $i<=$this->numPages; ++$i)
			$nav[$i] = $i;
		return $nav;
	}
}
