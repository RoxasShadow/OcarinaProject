<?php
/**
	core/class.Security.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe include tutti i metodi per la sicurezza. */
class Security {
	
	/* Filtra una stringa. Se l'argomento è un array multidimensionale, ogni array che lo compone viene ripassato nel metodo. Se, altrimenti, è un semplice array o una stringa, ogni valore è filtrato da mysql_real_escape_string().
	Poichè uso htmlentities(), tutto l'HTML presente non verrà parsato, quindi questo metodo non dovrà essere usato nella amministrazione (altrimenti non potrai creare, ad esempio, una tabella con il puro HTML, se non usando i BBCode, ma non penso riuscirai ad usare un BBCode per ogni tag esistente :). Basterà però creare un metodo identico ma senza htmlentities(). */
	public function purge($var) {
		if(is_array($var)) {
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->purge($var[$key]);
				if(is_string($var[$key])) {
					if(get_magic_quotes_gpc())
						$var[$key] = stripslashes($var[$key]);
					$var[$key] = mysql_real_escape_string(htmlentities($var[$key]));
				}
			}
		}
		if(is_string($var)) {
			if(get_magic_quotes_gpc())
				$var = stripslashes($var);
			$var = mysql_real_escape_string(htmlentities($var));
		}
		return $var;
	}
	
	/* Rimuove i filtri da una stringa. Se l'argomento è un array multidimensionale, ogni array che lo compone viene ripassato nel metodo. Se, altrimenti, è un semplice array o una stringa, ogni valore è pulito da stripslashes(). */
	public function unPurge($var) {
		if(is_array($var)) {
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->unPurge($var[$key]);
				if(is_string($var[$key])) {
					$var[$key] = stripslashes($var[$key]);
				}
			}
		}
		if(is_string($var)) {
			$var = stripslashes($var);
		}
		return $var;
	}
	
	/* Controlla l'autenticità di un indirizzo email (solo sintatticamente). */
	public function isEmail($email) {
		return preg_match('/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/', $email) ? true : false;
	}
	
	/* Controlla l'autenticità di un URL (solo sintatticamente). */
	public function isURL($url) {
		return preg_match('/^(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?/i', $url) ? true : false;
	}
	
	/* Genera delle stringhe alfanumeriche pseudocasuali. */
	public function rng($num) {
		$array = array();
		$str = '';
		for($i=0; $i<$num; $i++)
			$array[$i] = chr(rand(97, 122));
		for($i=0; $i<$num; $i++)
			$str .= $array[$i];
		return md5(md5($str));
	}
	
	/* Ritorna un array contenente informazioni sul client. */
	function getClient() {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$browser = 'Unknown';
		$browserAgent = '';
		$platform = 'Unknown';
		$version= '';

		// Platform
	    	if(preg_match('/linux/i', $useragent))
	    		$platform = 'Linux';
	    	elseif(preg_match('/macintosh|mac os x/i', $useragent))
	    		$platform = 'Mac OS X';
	    	elseif(preg_match('/windows|win32/i', $useragent))
	    		$platform = 'Microsoft Windows';
	   
	   	// Browser
	    	if(preg_match('/MSIE/i', $useragent) && !preg_match('/Opera/i',$useragent)) {
	    		$browser = 'Internet Explorer';
	    		$browserAgent = 'MSIE';
	    	}
	    	elseif(preg_match('/Firefox/i',$useragent)) {
	    		$browser = 'Mozilla Firefox';
	    		$browserAgent = 'Firefox';
	    	}
	    	elseif(preg_match('/Chrome/i', $useragent)) {
	    		$browser = 'Google Chrome';
	    		$browserAgent = 'Chrome';
	    	}
	    	elseif(preg_match('/Safari/i', $useragent)) {
	    		$browser = 'Safari';
	    		$browserAgent = 'Safari';
	    	}
	    	elseif(preg_match('/Opera/i', $useragent)) {
	    		$browser = 'Opera';
	    		$browserAgent = 'Opera';
	    	}
	    	elseif(preg_match('/Netscape/i', $useragent)) {
	    		$browser = 'Netscape';
	    		$browserAgent = 'Netscape';
	    	}
	    	elseif(preg_match('/Lynx/i', $useragent)) {
	    		$browser = 'Lynx';
	    		$browserAgent = 'lynx';
	    	}
	    	elseif(preg_match('/w3m/i', $useragent)) {
	    		$browser = 'w3m';
	    		$browserAgent = 'w3m';
	    	}
	    		
	    	// Version
		$known = array('Version', $browserAgent, 'other');
		$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if(!preg_match_all($pattern, $useragent, $matches)) {}
		
		$i = count($matches['browser']);
		if($i != 1)
			$version = strripos($useragent, "Version") < strripos($useragent, $browserAgent) ? $matches['version'][0] : $matches['version'][1];
		else
			$version = $matches['version'][0];
		if($version == null || $version == '')
			$version = '0x00';
	   
		return array(
			'useragent' => $useragent,
			'name'      => $browser,
			'version'   => $version,
			'platform'  => $platform
	    	);
	}
}
