<?php
/**
	/etc/class.BBCode.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di reversare il BBCode in HTML. */
class BBCode extends Configuration {
	private $translator = NULL;
	
	public function __construct() {
		parent::__construct();
		//include_once('class.Translator.php');
		//$this->translator = new Translator();
	}
	
	public function bbcode($text) {
		$pattern = array(
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
			'/\[code\](.*?)\[\/code\]/is',
			'/\[quote](.*?)\[\/quote\]/is',
			'/\[youtube\](.*)youtube.com\/watch\?v=(.*)\[\/youtube\]/is',
			'/\[user\](.*?)\[\/user\]/is',
			'/&lt;3/',
			'/:3/',
			'/\(C\)/is',
			'/\(R\)/is'
		);
		$replace = array(
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1">$2</a>',
			'<input type="submit" class="buttonSpoiler" value="Mostra/Nascondi" /><div class="spoiler">$1</div>',
			'<img src="$1" alt="$1" />',
			'<img src="$3" width="$1" height="$2" alt="$3" />',
			'<div align="center">$1</div>',
			'<div align="right">$1</div>',
			'<div align="left">$1</div>',
			'<h2>$1</h2>',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<iframe width="560" height="349" src="http://www.youtube.com/embed/\\2" frameborder="0"></iframe>',
			'<a href="'.$this->config[0]->url_index.'/profile/$1.html">$1</a>',
			'♥',
			'☻',
			'&copy;',
			'&reg;'
		);
		return nl2br(preg_replace($pattern, $replace, $text));
	}
	
	public function bbcodecommenti($text) {
		$pattern = array(
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
			'/\[code\](.*?)\[\/code\]/is',
			'/\[quote](.*?)\[\/quote\]/is',
			'/\[user\](.*?)\[\/user\]/is',
			'/\[translate from\=(.*?) to\=(.*?)\](.*?)\[\/translate\]/is',
			'/&lt;3/',
			'/:3/',
			'/\(C\)/is',
			'/\(R\)/is'
		);
		$replace = array(
			'<strong>$1</strong>',
			'<em>$1</>$>',
			'<u>$1</u>',
			'<s>$1</s>',
			'<font color="$1">$2</font>',
			'<a href="$1" target="_blank">$2</a>',
			'<input type="submit" class="buttonSpoiler" value="Mostra/Nascondi" /><div class="spoiler">$1</div>',
			'<div align="center">$1</div>',
			'<div align="right">$1</div>',
			'<div align="left">$1</div>',
			'<textarea style="border: 0px; overflow: auto; width:100%;" rows="8">$1</textarea>',
			'<blockquote><span>$1</span></blockquote>',
			'<a href="'.$this->config[0]->url_index.'/profile/$1.html">$1</a>',
			//$this->translator->translate('$3', '$1', '$2'),
			'',
			'♥',
			'☻',
			'&copy;',
			'&reg;'
		);
		return nl2br(preg_replace($pattern, $replace, $text));
	}
}
