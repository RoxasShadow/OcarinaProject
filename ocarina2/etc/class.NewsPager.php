<?php
/**
	/etc/class.NewsPager.php
	(C) Giovanni Capuano 2011
*/
require_once('./core/class.News.php');

/* Questa classe permette di creare un navigatore per le news. */
class NewsPager extends News {
	public $totale, $max, $currentPage, $numPages, $min = NULL;
	
	public function __construct($max) {
		parent::__construct();
		$this->totale = parent::countNews();
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
