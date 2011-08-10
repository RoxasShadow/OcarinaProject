<?php
class CSRF implements FrameworkPlugin {
	private $csrf_form_field = 'token';
	private $lifetime = 3600; // Tempo per cui un token è valido.
	
	private function getSentences() {
		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$array = array();
		if($language == 'it') {
			$array['invalid'] = 'Token invalido.';
			$array['blocked'] = 'Attacco CSRF bloccato.';
		}
		else {
			$array['invalid'] = 'Invalid token.';
			$array['blocked'] = 'CSRF attack blocked.';
		}
		return $array;
	}
	
	public function main($templateVarList) {
		if(session_id() == '')
			session_start();
		$language = $this->getSentences();
		$csrf_token = $this->generate_token();
		if(!empty($_POST)) {
			if(empty($_POST[$this->csrf_form_field])) {
				$this->error($language['invalid']);
				return;
			}
			$form_token = $_POST[$this->csrf_form_field];
			if($form_token !== $csrf_token) {
				$this->error($language['blocked']);
				return;
			}
		}
		if((substr($_SERVER['REQUEST_URI'], -5) !== '.html') && (!empty($_GET))) { // Mod_rewrited .html don't need it
			if(empty($_GET[$this->csrf_form_field])) {
				$this->error($language['invalid']);
				return;
			}
			$form_token = $_GET[$this->csrf_form_field];
			if($form_token !== $csrf_token) {
				$this->error($language['blocked']);
				return;
			}
		}
		ob_start(array($this, 'ob_callback'));
		ob_start(array($this, 'ob_callback2'));
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
	
	public function ob_callback($html) { // POST
		if(!$this->is_html_file($html))
			return $html;
		$token = $this->generate_token();
		$hidden = '<input type="hidden" name="'.$this->csrf_form_field.'" value="'.$token.'"'.($this->is_xhtml($html) ? ' />' : '>');
		// return preg_replace('/(<form\W[^>]*\bmethod=(\'|"|)POST(\'|"|)\b[^>]*>)/i', '\\1'.$hidden, $html);
		/* The rows above adds the token field after the opener of the POST tag.
		   The follow results to be faster adding the field just before of the closure of the form. */
		return str_replace('</form>', "$hidden\n</form>", $html);
	}
	
	public function ob_callback2($html) { // GET
		if(!$this->is_html_file($html))
			return $html;
		$token = $this->generate_token();
		return preg_replace('/<a href="(.*?)\?(.*?)"/i', '<a href="\\1?\\2&token='.$token.'"', $html); // I need it now :P
	}
	
	private function generate_token() {
		if((isset($_SESSION['token-id'])) && (isset($_SESSION['token-time'])) && ((time() - $_SESSION['token-time']) <= $this->lifetime))
			return $_SESSION['token-id'];
		$array = array();
		$str = '';
		$num = 10;
		for($i=0; $i<$num; $i++)
			$array[$i] = chr(rand(97, 122));
		for($i=0; $i<$num; $i++)
			$str .= $array[$i];
		$str = md5(md5((isset($_SESSION['token-id'])) ? $_SESSION['token-id'].$str : $str)); // If there is the old token, I use that as a salt, because all is gold :)
		$_SESSION['token-id'] = $str;
		$_SESSION['token-time'] = time();
		return $str;
	}
	
	private function error($msg) {
		die($msg);
	}
	
	private function is_html_file($html) {
		$sent_headers = headers_list();
		foreach($sent_headers as $header) 
			if(preg_match('/^Content-Type:/i', $header) && strpos($header, 'text/html') === false)
				return false;
		return true;
	}
	
	private function is_xhtml($html) {
		return strpos($html, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML') !== false;
	}
}
