<?php
/**
	/etc/class.BBCode.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di reversare il BBCode in HTML. */
class BBCode extends Configuration {
	private $config = NULL;
	
	public function __construct() {
		parent::__construct();
		$this->config = parent::getConfig();
	}
	
	public function bbcode($txt) {
		$cerca_codice = array(
			'/\[b\](.*?)\[\/b\]/is',
			'/\[i\](.*?)\[\/i\]/is',
			'/\[u\](.*?)\[\/u\]/is',
			'/\[s\](.*?)\[\/s\]/is',
			'/\[color\=(.*?)\](.*?)\[\/color\]/is',
			'/\[url\=(.*?)\](.*?)\[\/url\]/is',
			'/\[spoiler\](.*?)\[\/spoiler\]/is',
			'/\[img\](.*?)\[\/img\]/is',
			'/\[img width\=(.*?) height\=(.*?)\](.*?)\[\/img\]/is',
			'/\[center](.*?)\[\/center\]/is',
			'/\[right](.*?)\[\/right\]/is',
			'/\[left](.*?)\[\/left\]/is',
			'/\[summary](.*?)\[\/summary\]/is',
			'/\[br]/is',
			'/\[code\](.*?)\[\/code\]/is',
			'/\[quote](.*?)\[\/quote\]/is',
			'/\[nervoso\]/is',
			'/\[youtube\](.*)youtube.com\/watch\?v=(.*)\[\/youtube\]/is'
		);
		$sostituisci_codice = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1">$2</a>',
			'<a onclick="Spoiler();">Mostra/Nascondi</a><div class="spoiler">$1</div>',
			'<img src="$1">',
			'<a href="$3"><img src="$3" width="$1" height="$2"></a>',
			'<p align="center">$1</p>',
			'<p align="right">$1</p>',
			'<p align="left">$1</p>',
			'<h2>$1</h2>',
			'<br />',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<img src="'.$this->config[0]->url_immagini.'/nervoso.gif">',
			"<object width=\"425\" height=\"344\"><param name=\"movie\" value=\"http://www.youtube.com/v/\\2&hl=de&fs=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"http://www.youtube.com/v/\\2&hl=de&fs=1\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed></object>"
		);
		$txt = preg_replace ($cerca_codice, $sostituisci_codice, $txt);
		return $txt;
	}

	public function bbcodecommenti($testo) {
		$cerca_codice = array(
			'/\[b\](.*?)\[\/b\]/is',
			'/\[i\](.*?)\[\/i\]/is',
			'/\[u\](.*?)\[\/u\]/is',
			'/\[s\](.*?)\[\/s\]/is',
			'/\[color\=(.*?)\](.*?)\[\/color\]/is',
			'/\[url\=(.*?)\](.*?)\[\/url\]/is',
			'/\[spoiler\](.*?)\[\/spoiler\]/is',
			'/\[center](.*?)\[\/center\]/is',
			'/\[right](.*?)\[\/right\]/is',
			'/\[left](.*?)\[\/left\]/is',
			'/\[br]/is',
			'/\[code\](.*?)\[\/code\]/is',
			'/\[quote](.*?)\[\/quote\]/is',
			'/\[nervoso\]/is',
			'/\[user\](.*?)\[\/user\]/is'
		);
		$sostituisci_codice = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1">$2</a>',
			'<a onclick="Spoiler();">Mostra/Nascondi</a><div class="spoiler">$1</div>',
			'<p align="center">$1</p>',
			'<p align="right">$1</p>',
			'<p align="left">$1</p>',
			'<br />',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<img src="'.$this->config[0]->url_immagini.'/swanp/wysiwyg/emoticons/nervoso.gif">',
			'<a href="'.$this->config[0]->url_index.'/profilo.php?nickname=$1">$1</a>'
		);
		$testo = preg_replace($cerca_codice, $sostituisci_codice, $testo);
		return $testo;
	}
}
