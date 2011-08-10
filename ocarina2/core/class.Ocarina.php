<?php
/**
	core/class.Ocarina.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Rendering.php');

/* Istanziando questa classe, è possibile usufruire di tutti i metodi e attributi delle sottoclassi facenti parte del core. */
class Ocarina extends Rendering {
	public function __construct() {
		parent::__construct();
		require_once('class.Plugin.php');
		if($this->config[0]->plugin == 1) {
			$plugins = Plugin::listPlugins();
			$varList = parent::getValues();
			foreach($plugins as $element)
				if((Plugin::getMetadata($element, 'enabled', '') == 'true') && (!file_exists($this->config[0]->root_index.'/plugin/plugins/'.$element.'/plugin.cfg')))
					try {
						$plugin = Plugin::loadPlugin($element);
						$output = $plugin->main($varList);
						if(is_array($output))
							foreach($output as $name => $value)
								if(($name !== '') && ($value !== ''))
									parent::addValue($name, $value);
					}
					catch(Exception $e) {
						echo $e->getMessage();
					}
			unset($plugins);
		}
	}
}
