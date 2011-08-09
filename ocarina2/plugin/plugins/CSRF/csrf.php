<?php
/**
	etc/class.CSRF.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe permette di difendersi dagli attacchi di tipo CSRF, inserendo un campo hidden all'interno di ogni form contenente un token, che viene validato al momento dell'invio. */
class CSRF implements FrameworkPlugin {
	private $csrf_form_field = 'token';
	private $lifetime = 3600; // Tempo per cui un token è valido.
	
	public function main($templateVarList) {
		session_start();
		$csrf_token = $this->generate_token();
		if(!empty($_POST)) {
			if(empty($_POST[$this->csrf_form_field])) {
				$this->error('Token not valid.');
				return;
			}
			$form_token = $_POST[$this->csrf_form_field];
			if($form_token !== $csrf_token) {
				$this->error('CSRF attack detected and blocked.');
				return;
			}
		}
		ob_start(array($this, 'ob_callback'));
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
	
	public function ob_callback($html) {
		if(!$this->is_html_file($html))
			return $html;
		$token = $this->generate_token();
		$hidden = '<input type="hidden" name="'.$this->csrf_form_field.'" value="'.$token.'"'.($this->is_xhtml($html) ? ' />' : '>');
		// return preg_replace('/(<form\W[^>]*\bmethod=(\'|"|)POST(\'|"|)\b[^>]*>)/i', '\\1'.$hidden, $html);
		/* La riga qui sopra inserisce il campo per il token subito dopo l'apertura di un form di tipo POST.
		Il seguente risulta essere più veloce, ed inserisce il campo subito prima la chiusura di un qualsiasi tipo di campo. */
		return str_replace('</form>', "$hidden\n</form>", $html);
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
		$str = md5(md5((isset($_SESSION['token-id'])) ? $_SESSION['token-id'].$str : $str)); // Se c'è ancora il vecchio token, lo utilizzo come salt :)
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
