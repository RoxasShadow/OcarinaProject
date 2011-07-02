<?php
/**
	/etc/class.BBCode.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di reversare il BBCode in HTML. */
class BBCode extends Configuration {

	public function __construct() {
		parent::__construct();
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
			'/\[youtube\](.*)youtube.com\/watch\?v=(.*)\[\/youtube\]/is',
			'/&lt;3/',
			'/:3/',
			'/\(C\)/is',
			'/\(R\)/is'
		);
		$sostituisci_codice = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1">$2</a>',
			'<div align="center"><input type="submit" class="buttonSpoiler" value="Mostra/Nascondi" /></div><div class="spoiler">$1</div>',
			'<img src="$1">',
			'<a href="$3"><img src="$3" width="$1" height="$2"></a>',
			'<div align="center">$1</div>',
			'<div align="right">$1</div>',
			'<div align="left">$1</div>',
			'<h2>$1</h2>',
			'<br />',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<iframe width="560" height="349" src="http://www.youtube.com/embed/\\2" frameborder="0"></iframe>',
			'♥',
			'☻',
			'&copy;',
			'&reg;'
		);
		return preg_replace($cerca_codice, $sostituisci_codice, $txt);
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
			'/\[user\](.*?)\[\/user\]/is',
			'/&lt;3/',
			'/:3/',
			'/\(C\)/is',
			'/\(R\)/is'
		);
		$sostituisci_codice = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1">$2</a>',
			'<a onclick="spoiler();">Mostra/Nascondi</a><div class="spoiler">$1</div>',
			'<div align="center">$1</div>',
			'<div align="right">$1</div>',
			'<div align="left">$1</div>',
			'<br />',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<a href="'.$this->config[0]->url_index.'/profilo.php?nickname=$1">$1</a>',
			'♥',
			'☻',
			'&copy;',
			'&reg;'
		);
		return preg_replace($cerca_codice, $sostituisci_codice, $testo);
	}
}
