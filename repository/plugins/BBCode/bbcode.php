<?php
/**
	/plugin/CSRF/BBCode/bbcode.php
	(C) Giovanni Capuano 2011
*/
class BBCode extends Configuration implements FrameworkPlugin {
	public function main($templateVarList) {
		$rendering = array();
		if((isset($templateVarList['news'])) && (is_array($templateVarList['news'])) && (!empty($templateVarList['news']))) {
			for($i=0, $count=count($templateVarList['news']); $i<$count; ++$i)
				$templateVarList['news'][$i]->contenuto = $this->textToBBCode($templateVarList['news'][$i]->contenuto);
			$rendering['news'] = $templateVarList['news'];
		}
		if((isset($templateVarList['pagine'])) && (is_array($templateVarList['pagine'])) && (!empty($templateVarList['pagine']))) {
			for($i=0, $count=count($templateVarList['pagine']); $i<$count; ++$i)
				$templateVarList['pagine'][$i]->contenuto = $this->textToBBCode($templateVarList['pagine'][$i]->contenuto);
			$rendering['pagine'] = $templateVarList['pagine'];
		}
		if((isset($templateVarList['pagina'])) && (is_array($templateVarList['pagina'])) && (!empty($templateVarList['pagina']))) {
			for($i=0, $count=count($templateVarList['pagina']); $i<$count; ++$i)
				$templateVarList['pagina'][$i]->contenuto = $this->textToBBCode($templateVarList['pagina'][$i]->contenuto);
			$rendering['pagina'] = $templateVarList['pagina'];
		}
		if((isset($templateVarList['commenti'])) && (is_array($templateVarList['commenti'])) && (!empty($templateVarList['commenti']))) {
			for($i=0, $count=count($templateVarList['commenti']); $i<$count; ++$i)
				$templateVarList['commenti'][$i]->contenuto = $this->commentToBBCode($templateVarList['commenti'][$i]->contenuto);
			$rendering['commenti'] = $templateVarList['commenti'];
		}
		if((isset($templateVarList['commento'])) && (is_array($templateVarList['commento'])) && (!empty($templateVarList['commento']))) {
			for($i=0, $count=count($templateVarList['commento']); $i<$count; ++$i)
				$templateVarList['commento'][$i]->contenuto = $this->commentToBBCode($templateVarList['commento'][$i]->contenuto);
			$rendering['commento'] = $templateVarList['commento'];
		}
		return $rendering;
	}
	
	public function manipulate($type, $text) {
		return ($type == 'comment') ? $this->commentToBBCode($text) : $this->textToBBCode($text);
	}
	
	private function textToBBCode($text) {
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
			'/\(R\)/is',
			'/\[br]/is'
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
			'&reg;',
			''
		);
		$toPurge = nl2br(preg_replace($pattern, $replace, $text));
		$new = preg_replace('/(.*?)\[nobr\](.*?)\[\/nobr\]/is', '\\1', $toPurge);
		if(preg_match_all('/\[nobr\](.*?)\[\/nobr\]/is', $toPurge, $matches))
				$new .= preg_replace('/<(\s+)?br[^>]+>/', '', $matches[0][0]);
		return str_replace(array('[nobr]', '[/nobr]'), '', $new);
	}
	
	private function commentToBBCode($text) {
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
			'/&lt;3/',
			'/:3/',
			'/\(C\)/is',
			'/\(R\)/is',
			'/\$([A-Za-z0-9]+)(?=)/',
			'/\[br]/is'
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
			'',
			'♥',
			'☻',
			'&copy;',
			'&reg;',
			'<a href="'.$this->config[0]->url_index.'/ricerca.php?commenti=$\\1">$\\1</a>',
			''
		);
		$toPurge = nl2br(preg_replace($pattern, $replace, $text));
		$new = preg_replace('/(.*?)\[nobr\](.*?)\[\/nobr\]/is', '\\1', $toPurge);
		if(preg_match_all('/\[nobr\](.*?)\[\/nobr\]/is', $toPurge, $matches))
				$new .= preg_replace('/<(\s+)?br[^>]+>/', '', $matches[0][0]);
		return str_replace(array('[nobr]', '[/nobr]'), '', $new);
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}
