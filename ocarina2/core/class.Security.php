<?php
/**
	core/class.Security.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe include tutti i metodi per la sicurezza. */
class Security {
	
	/* Filtra una stringa. Se l'argomento è un array multidimensionale, ogni array che lo compone viene ripassato nel metodo.
	   Se, altrimenti, è un semplice array o una stringa, ogni valore è filtrato da mysql_real_escape_string().
	   ATTENZIONE: Non usare per le news e le pagine, altrimenti l'HTML non sarà parsato! */
	public function purge($var) {
		if(is_array($var)) {
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->purge($var[$key]);
				if(is_string($var[$key])) {
					if(get_magic_quotes_gpc())
						$var[$key] = stripslashes($var[$key]);
					$var[$key] = trim(mysql_real_escape_string(htmlentities($var[$key])));
				}
			}
		}
		if(is_string($var)) {
			if(get_magic_quotes_gpc())
				$var = stripslashes($var);
			$var = trim(mysql_real_escape_string(htmlentities($var)));
		}
		return $var;
	}
	
	/* Elimina gli slashes per le SQL Injection. */
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
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url) ? true : false;
	}
	
	/* Controlla l'autenticità di un link ad un'immagine. */
	public function isImage($url) {
		$params = array('http' => array('method' => 'HEAD'));
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if(!$fp) 
			return false;
		$meta = stream_get_meta_data($fp);
		if($meta === false) {
			fclose($fp);
			return false;
		}
		$wrapper_data = $meta['wrapper_data'];
		if(is_array($wrapper_data)) {
			foreach(array_keys($wrapper_data) as $hh) {
				if(substr($wrapper_data[$hh], 0, 19) == 'Content-Type: image') {
					fclose($fp);
					return true;
				}
			}
		}
		fclose($fp);
		return false;
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
		$useragent = htmlentities($_SERVER['HTTP_USER_AGENT']);
		$browser = 'Unknown';
		$browserAgent = '';
		$platform = 'Unknown';
		$version= '';

		// Platform
	    	if(preg_match('/linux/i', $useragent))
	    		$platform = 'GNU/Linux';
	    	elseif(preg_match('/macintosh|mac os x/i', $useragent))
	    		$platform = 'Mac OS X';
	    	elseif(preg_match('/windows|win32/i', $useragent))
	    		$platform = 'Microsoft Windows';
	   
	   	// Browser
	   	// Look here <http://www.useragentstring.com/pages/useragentstring.php> :)
	   	// Se usi un browser basato su un altro (come Iceweasel per Firefox), aggiungi prima la derivata e poi la base.
	    	if(preg_match('/Opera/i', $useragent)) {
	    		$browser = 'Opera';
	    		$browserAgent = 'Opera';
	    	}
	    	elseif(preg_match('/MSIE/i', $useragent)) {
	    		$browser = 'Internet Explorer';
	    		$browserAgent = 'MSIE';
	    	}
	    	elseif(preg_match('/Iceweasel/i', $useragent)) {
	    		$browser = 'Iceweasel';
	    		$browserAgent = 'Iceweasel';
	    	}
	    	elseif(preg_match('/GranParadiso/i', $useragent)) {
	    		$browser = 'GranParadiso';
	    		$browserAgent = 'GranParadiso';
	    	}
	    	elseif(preg_match('/Netscape/i', $useragent)) {
	    		$browser = 'Netscape';
	    		$browserAgent = 'Netscape';
	    	}
	    	elseif(preg_match('/Epiphany/i', $useragent)) {
	    		$browser = 'Epiphany';
	    		$browserAgent = 'Epiphany';
	    	}
	    	elseif(preg_match('/msnbot/i', $useragent)) {
	    		$browser = 'Msnbot';
	    		$browserAgent = 'msnbot';
	    	}
	    	elseif(preg_match('/Yahoo/i', $useragent)) {
	    		$browser = 'Yahoo! Slurp';
	    		$browserAgent = 'Mozilla';
	    	}
	    	elseif(preg_match('/Googlebot/i', $useragent)) {
	    		$browser = 'Googlebot';
	    		$browserAgent = 'Googlebot';
	    	}
	    	elseif(preg_match('/Chrome/i', $useragent)) {
	    		$browser = 'Google Chrome';
	    		$browserAgent = 'Chrome';
	    	}
	    	elseif(preg_match('/Iceweasel/i', $useragent)) {
	    		$browser = 'Iceweasel';
	    		$browserAgent = 'Iceweasel';
	    	}
	    	elseif(preg_match('/Konqueror/i', $useragent)) {
	    		$browser = 'Konqueror';
	    		$browserAgent = 'Konqueror';
	    	}
	    	elseif(preg_match('/PSP/i', $useragent)) {
	    		$browser = 'PSP';
	    		$browserAgent = 'PSP';
	    	}
	    	elseif(preg_match('/Playstation/i', $useragent)) {
	    		$browser = 'Playstation';
	    		$browserAgent = 'Playstation';
	    	}
	    	elseif(preg_match('/PSP/i', $useragent)) {
	    		$browser = 'PSP';
	    		$browserAgent = 'PSP';
	    	}
	    	elseif(preg_match('/Wii/i', $useragent)) {
	    		$browser = 'Wii';
	    		$browserAgent = 'Wii';
	    	}
	    	elseif(preg_match('/Xbox/i', $useragent)) {
	    		$browser = 'Xbox';
	    		$browserAgent = 'Xbox';
	    	}
	    	elseif(preg_match('/Iphone/i', $useragent)) {
	    		$browser = 'Iphone';
	    		$browserAgent = 'Iphone';
	    	}
	    	elseif(preg_match('/Ipod/i', $useragent)) {
	    		$browser = 'Ipod';
	    		$browserAgent = 'Ipod';
	    	}
	    	elseif(preg_match('/Safari/i', $useragent)) {
	    		$browser = 'Safari';
	    		$browserAgent = 'Safari';
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
	    	elseif(preg_match('/Firefox/i',$useragent)) {
	    		$browser = 'Mozilla Firefox';
	    		$browserAgent = 'Firefox';
	    	}
	    		
	    	// Version
		$known = array('Version', $browserAgent, 'other');
		$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if(!preg_match_all($pattern, $useragent, $matches)) {}
		
		$i = count($matches['browser']);
		if($i != 1)
			$version = @strripos($useragent, "Version") < strripos($useragent, $browserAgent) ? $matches['version'][0] : $matches['version'][1];
		else
			$version = $matches['version'][0];
		if($version == null || $version == '')
			$version = '0x00';
	   
		return array(
			'useragent' => $useragent,
			'browser'   => $browser,
			'version'   => $version,
			'platform'  => $platform
	    	);
	}
	
	/* Taglia una stringa. */
	public function reduceLen($news, $max, $append='') {
		if(strlen($news) <= $max)
			return $news;
		$newsreduced = explode('|', wordwrap($news, $max, '|'));
		return substr($newsreduced[0], 0, -1).'...'.$append;
	}
}
