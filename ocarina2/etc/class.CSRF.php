<?php
/**
	etc/class.CSRF.php
	(C) Giovanni Capuano 2011
*/

/* Versione modificata della classe CsrfProtect di Simon Willson. */
class CSRF {
	private $csrf_form_field = 'token';
	
	function __construct() {
		session_start();
	}
	
	function generate_token() {
		/* Ricorda che dopo 1 ora (3600 secondi), il token diventa invalido, e dovrai quindi aggiornare la pagina se vuoi inviare un POST, o verrai segnalato per un attack attempt. */
		if((isset($_SESSION['token-id'])) && (isset($_SESSION['token-time'])) && ((time() - $_SESSION['token-time']) <= 3600))
			return $_SESSION['token-id'];
		$array = array();
		$str = '';
		$num = 10;
		for($i=0; $i<$num; $i++)
			$array[$i] = chr(rand(97, 122));
		for($i=0; $i<$num; $i++)
			$str .= $array[$i];
		$str = md5(md5((isset($_SESSION['token-id'])) ? $_SESSION['token-id'].$str : $str)); // Se c'è ancora il vecchio token, lo utilizzo come salt :)
		return $str;
	}
	
	function error($msg) {
		die($msg);
	}
	
	function enable() {
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
	
	function is_html_file($html) {
		$sent_headers = headers_list();
		foreach($sent_headers as $header) 
			if(preg_match('/^Content-Type:/i', $header) && strpos($header, 'text/html') === false)
				return false;
		return true;
	}
	
	function is_xhtml($html) {
		return strpos($html, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML') !== false;
	}
	
	function ob_callback($html) {
		if(!$this->is_html_file($html))
			return $html;
		$token = $this->generate_token();
		$hidden = '<input type="hidden" name="'.$this->csrf_form_field.'" value="'.$token.'"'.($this->is_xhtml($html) ? ' />' : '>');
		// return preg_replace('/(<form\W[^>]*\bmethod=(\'|"|)POST(\'|"|)\b[^>]*>)/i', '\\1'.$hidden, $html);
		/* La riga qui sopra inserisce il campo per il token subito dopo l'apertura di un form di tipo POST.
		Il seguente risulta essere più veloce, ed inserisce il campo subito prima la chiusura di un qualsiasi tipo di campo. */
		return str_replace('</form>', "$hidden\n</form>", $html);
	}
}
