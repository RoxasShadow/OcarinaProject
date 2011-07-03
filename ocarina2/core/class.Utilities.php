<?php
/**
	core/class.Utilities.php
	(C) Giovanni Capuano 2011
*/

/* Questa classe include di tutto: dai metodi per la sicurezza alle convalide degli url, fino alla gestione delle stringhe. */
class Utilities {
	
	/* Filtra una stringa o un array multidimensionale.
	   ATTENZIONE: Non usare per la creazione di news e le pagine, altrimenti l'HTML non sarà parsato! */
	public function purge($var) {
		if(is_array($var))
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->purge($var[$key]);
				if((is_string($var[$key])) && (!is_numeric($var[$key]))) {
					if(get_magic_quotes_gpc())
						$var[$key] = stripslashes($var[$key]);
					$var[$key] = trim(mysql_real_escape_string(htmlentities($this->purgeByXSS($var[$key]))));
				}
			}
		if((is_string($var)) && (!is_numeric($var))) {
			if(get_magic_quotes_gpc())
				$var = stripslashes($var);
			$var = trim(mysql_real_escape_string(htmlentities($this->purgeByXSS($var))));
		}
		return $var;
	}
	
	/* Elimina gli slashes per le SQL Injection. */
	public function unPurge($var) {
		if(is_array($var))
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->unPurge($var[$key]);
				if((is_string($var[$key])) && (!is_numeric($var[$key])))
					$var[$key] = stripslashes($var[$key]);
			}
		if((is_string($var)) && (!is_numeric($var)))
			$var = stripslashes($var);
		return $var;
	}
	
	/* Filtra una stringa o un array multidimensionale da XSS.
	   Da usare per la creazione di news e pagine, poichè permette HTML ma non XSS. */
	public function purgeByXSS($var) {
		if(is_array($var))
			foreach($var as $key => $value) {
				if(is_array($var[$key]))
					$var[$key] = $this->purgeByXSS($var[$key]);
				if((is_string($var[$key])) && (!is_numeric($var[$key]))) {
					$var[$key] = str_ireplace('<script', '&lt;script', $var[$key]);
					$var[$key] = str_ireplace('%3C%73%63%72%69%70%74%3E', '&lt;script', $var[$key]);
					$var[$key] = str_ireplace('&#x3C;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;', '&lt;script', $var[$key]);
					$var[$key] = str_ireplace('&#60&#115&#99&#114&#105&#112&#116&#62', '&lt;script', $var[$key]);
					$var[$key] = str_ireplace('PHNjcmlwdD4=', '&lt;script', $var[$key]);
					$var[$key] = str_ireplace('script>', 'script&gt;', $var[$key]);
					$var[$key] = str_ireplace('%3C%2F%73%63%72%69%70%74%3E', 'script&gt;', $var[$key]);
					$var[$key] = str_ireplace('&#x3C;&#x2F;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;', 'script&gt;', $var[$key]);
					$var[$key] = str_ireplace('&#60&#47&#115&#99&#114&#105&#112&#116&#62', 'script&gt;', $var[$key]);
					$var[$key] = str_ireplace('PC9zY3JpcHQ+', 'script&gt;', $var[$key]);
				}
					
			}
		if((is_string($var)) && (!is_numeric($var))) {
			$var = str_ireplace('<script', '&lt;script', $var);
			$var = str_ireplace('%3C%73%63%72%69%70%74', '&lt;script', $var);
			$var = str_ireplace('&#x3C;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;', '&lt;script', $var);
			$var = str_ireplace('&#60&#115&#99&#114&#105&#112&#116', '&lt;script', $var);
			$var = str_ireplace('PHNjcmlwdA==', '&lt;script', $var);
			$var = str_ireplace('script>', 'script&gt;', $var);
			$var = str_ireplace('%73%63%72%69%70%74%3E', 'script&gt;', $var);
			$var = str_ireplace('&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;', 'script&gt;', $var);
			$var = str_ireplace('&#115&#99&#114&#105&#112&#116&#62', 'script&gt;', $var);
			$var = str_ireplace('c2NyaXB0Pg==', 'script&gt;', $var);
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
	
	/* Rimuove gli URL dal testo. */
	public function cleanTextFromURL($string) {
		return preg_replace('/\b(http(s)?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $string);
	}
	
	/* Crea un permalink da un testo. */
	public function permalink($string) {
		return preg_replace('/-+/', "-", preg_replace('/[^a-z0-9-]/', '-', strtolower($string)));
	}
	
	/* Ritorna true se la stringa inizia con un dato pattern. */
	public function startWith($string, $start) {
    		return (substr($string, 0, strlen($start)) == $start);
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
			foreach(array_keys($wrapper_data) as $hh)
				if(substr($wrapper_data[$hh], 0, 19) == 'Content-Type: image') {
					fclose($fp);
					return true;
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
	
	/* Ritorna il timestamp in millisecondi. */
	function microtime_float() {
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	/* Carica un'immagine. */
	function uploadImage($path, $FILES) {
		if((empty($FILES)) || (!is_array($FILES)))
			return false;
		do {
			if(is_uploaded_file($_FILES['image']['tmp_name'])) {
				list($width, $height, $type) = getimagesize($_FILES['image']['tmp_name']);
				if(($type !== 1) && ($type !== 2) && ($type !== 3)) // gif, jpg, png
					return false;
				if(file_exists($path.$_FILES['image']['name']))
					$_FILES['image']['name'] = rand(1,100).'_'.$_FILES['image']['name'];
				if(!move_uploaded_file($_FILES['image']['tmp_name'], $path.$_FILES['image']['name']))
					return false;
			}
		} while(false);
		return $_FILES['image']['name'];
	}
	
	/* Carica più immagini.
	L'attributo "name" di ogni tag input-file deve finire con due parentesi quadre (ex.: images[])*/
	function uploadMultipleImage($path, $FILES) {
		if((empty($FILES)) || (!is_array($FILES)))
			return false;
		$name = array();
		for($i=0, $count=count($FILES)-1; $i<$count; $i++) {
			do {
				if(is_uploaded_file($_FILES['image']['tmp_name'][$i])) {
					list($width, $height, $type) = getimagesize($_FILES['image']['tmp_name'][$i]);
					if(($type !== 1) && ($type !== 2) && ($type !== 3)) // gif, jpg, png
						return false;
					if(file_exists($path.$_FILES['image']['name'][$i]))
						$_FILES['image']['name'][$i] = rand(1,100).'_'.$_FILES['image']['name'][$i];
					if(!move_uploaded_file($_FILES['image']['tmp_name'][$i], $path.$_FILES['image']['name'][$i]))
						return false;
				}
			} while(false);
			$name[$i] = $_FILES['image']['name'][$i];
		}
		return $name;
	}
	
	/* Carica un'immagine da remoto. Richiede allow_url_fopen. */
	function uploadImageByRemote($path, $link) {
		$array = explode('/', $link);
		$name = $array[count($array)-1];
		$ext = substr($name, -3);
		while(file_exists($path.$name))
			$name = rand(1,100).'_'.$name;
		if(($ext == 'jpg') || ($ext == 'peg'))
			imagejpeg(imagecreatefromjpeg($link), $path.$name);
		elseif($ext == 'gif')
			imagegif(imagecreatefromgif($link), $path.$name);
		elseif($ext == 'png')
			imagepng(imagecreatefrompng($link), $path.$name);
		else
			return false;
		return $name;
	}
	
	/* Carica un'immagine da remoto per chi ha allow_url_fopen disabilitato. Richiede cURL. */
	function uploadImageByRemoteWithCurl($path, $link) {
		$ch = curl_init($link);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$rawdata = curl_exec($ch);
		curl_close($ch);
		$array = explode('/', $link);
		$name = $array[count($array)-1];
		while(file_exists($path.$name))
			$name = rand(1,100).'_'.$name;
		$f = fopen($path.$name, 'w');
		fwrite($f, $rawdata);
		fclose($f);
		return $name;
	}
	
	/* Ridimensiona un'immagine. */
	function resizeImage($path, $newPath, $newWidth, $newHeight) {
		list($width, $height) = getimagesize($path);
		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		$ext = substr($path, -3);
		while(file_exists($path.$name))
			$name = rand(1,100).'_'.$name;
		if(($ext == 'jpg') || ($ext == 'peg')) {
			imagecopyresized($thumb, imagecreatefromjpeg($path), 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($thumb, $newPath, 75);
		}
		elseif($ext == 'gif') {
			imagecopyresized($thumb, imagecreatefromgif($path), 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagegif($thumb, $newPath);
		}
		elseif($ext == 'png') {
			imagecopyresized($thumb, imagecreatefrompng($path), 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagepng($thumb, $newPath);
		}
		else
			return false;
		return $newPath;
	}
	
	/* Elimina un'immagine. */
	function deleteImage($path) {
		if(!file_exists($path))
			return false;
		return (unlink($path)) ? true : false;
	}
	
	/* Ritorna un array con le dimensioni di un'immagine in pixel. */
	function dimImage($path) {
		if(!file_exists($path))
			return false;
		list($width, $height) = getimagesize($path);
		return array($width, $height);
	}
}
