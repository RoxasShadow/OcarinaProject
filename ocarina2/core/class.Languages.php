<?php
/**
	core/class.Languages.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe include le lingue per il core. */
class Languages {
	/* Ritorna una stringa nella lingua usata dall'utente. */
	public function getLanguage($category, $val) {
		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		if(!file_exists('languages/'.$language.'.php'))
			$language = 'it';
		require_once('languages/'.$language.'.php');
		if(!$language = call_user_func('getLanguage_'.$language))
			die('Language filenot found.<br />Take your own on <a href="http://www.giovannicapuano.net">http://www.giovannicapuano.net</a>.');
		return ((!isset($language[$category])) || (!is_array($language[$category])) || (empty($language[$category])) || ((count($language[$category])) < $val)) ? false : $language[$category][$val];
	}
}
