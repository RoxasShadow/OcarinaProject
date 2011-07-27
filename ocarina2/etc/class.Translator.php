<?php

/**
 * Translating language with Google API
 * @author gabe@fijiwebdesign.com
 * @version $id$
 * @license - Share-Alike 3.0 (http://creativecommons.org/licenses/by-sa/3.0/)
 * 
 * Google requires attribution for their Language API, please see: http://code.google.com/apis/ajaxlanguage/documentation/#Branding
 * 
 */
class Translator {

	/**
	 * Translate a piece of text with the Google Translate API
	 * @return String
	 * @param $text String
	 * @param $from String[optional] Original language of $text. An empty String will let google decide the language of origin
	 * @param $to String[optional] Language to translate $text to
	 */
	function translate($text, $from = '', $to = 'en') {
		$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.rawurlencode($text).'&langpair='.rawurlencode($from.'|'.$to);
		$response = file_get_contents(
			$url,
			null,
			stream_context_create(
				array(
					'http'=>array(
					'method'=>"GET",
					'header'=>"Referer: http://".$_SERVER['HTTP_HOST']."/\r\n"
					)
				)
			)
		);
		if (preg_match("/{\"translatedText\":\"([^\"]+)\"/i", $response, $matches)) {
			return $this->_unescapeUTF8EscapeSeq($matches[1]);
		}
		return false;
	}
	
	/**
	 * Convert UTF-8 Escape sequences in a string to UTF-8 Bytes
	 * @return UTF-8 String
	 * @param $str String
	 */
	function _unescapeUTF8EscapeSeq($str) {
		return preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_NOQUOTES, \'UTF-8\');'), $str);
	}
}
?>
