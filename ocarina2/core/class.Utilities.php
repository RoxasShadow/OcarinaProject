<?php
/**
	core/class.Utilities.php
	(C) Giovanni Capuano 2011
*/
require_once('class.Languages.php');

/* Questa classe include di tutto: dai metodi per la sicurezza alle convalide degli url, fino alla gestione delle stringhe. */
class Utilities extends Languages {

	/* Purge e unPurge si trovano in class.MySQL.php. */
	
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
	
	/* Trasforma le entità HTML in entità XML. */
	public function xmlentities($var) {
		$xml = array('&#34;','&#38;','&#38;','&#60;','&#62;','&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;');
		$html = array('&quot;','&amp;','&amp;','&lt;','&gt;','&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
		$var = str_replace($html, $xml, $var);
		$var = str_ireplace($html, $xml, $var);
		return htmlentities($var);
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
	public function reduceLen($text, $max, $append='') {
		if(strlen($text) <= $max)
			return $text;
		$textreduced = explode('|', wordwrap($text, $max, '|'));
		return substr($textreduced[0], 0, -1).'...'.$append;
	}
	
	/* Crea un metatag description partendo da un testo. */
	public function getDescription($text) {
		return htmlentities($this->reduceLen(strip_tags($text), 151));
	}
	
	/* Ritorna il timestamp in millisecondi. */
	function microtime_float() {
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	/* Carica un'immagine. */
	function uploadImage($path, $name) {
		if((empty($_FILES[$name])) || (!is_array($_FILES[$name])))
			return false;
		do {
			if(is_uploaded_file($_FILES[$name]['tmp_name'])) {
				list($width, $height, $type) = getimagesize($_FILES[$name]['tmp_name']);
				if(($type !== 1) && ($type !== 2) && ($type !== 3)) // gif, jpg, png
					return false;
				if(file_exists($path.$_FILES[$name]['name']))
					$_FILES[$name]['name'] = rand(1,100).'_'.$_FILES[$name]['name'];
				if(!move_uploaded_file($_FILES[$name]['tmp_name'], $path.$_FILES[$name]['name']))
					return false;
			}
		} while(false);
		return $_FILES[$name]['name'];
	}
	
	/* Carica più immagini.*/
	function uploadMultipleImage($path, $name) {
		if((empty($_FILES[$name])) || (!is_array($_FILES[$name])))
			return false;
		$filename = array();
		for($i=0, $count=count($_FILES[$name]['name']); $i<$count; ++$i) {
			do {
				if(is_uploaded_file($_FILES[$name]['tmp_name'][$i])) {
					list($width, $height, $type) = getimagesize($_FILES[$name]['tmp_name'][$i]);
					if(($type !== 1) && ($type !== 2) && ($type !== 3)) // gif, jpg, png
						return false;
					if(file_exists($path.$_FILES[$name]['name'][$i]))
						$_FILES[$name]['name'][$i] = rand(1,100).'_'.$_FILES[$name]['name'][$i];
					if(!move_uploaded_file($_FILES[$name]['tmp_name'][$i], $path.$_FILES[$name]['name'][$i]))
						return false;
				}
			} while(false);
			$filename[$i] = $_FILES[$name]['name'][$i];
		}
		return $filename;
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

	/* Visualizza le immagini attualmente presenti. */
	public function getImage() {
		$dir = $this->config[0]->root_immagini.'/';
		$apri = opendir($dir);
		$f = array();
		while($image = readdir($apri))
			if(!is_dir($image))
				$f[] = $image;
		return $f;
	}

	/* Invia una email. */
	public function sendMail($destinatario, $titolo, $contenuto) {
		return mail($destinatario, $titolo, $contenuto) ? true : false;			
	}
	
	/* Cancella una cartella con tutto il suo contenuto. */
	public function deleteDir($dir) { 
		$handle = opendir($dir); 
		while (false !== ($FolderOrFile = readdir($handle)))
			if(($FolderOrFile !== '.') && ($FolderOrFile !== '..')) 
				if(is_dir($dir.'/'.$FolderOrFile)) 
		       			$this->deleteDir($dir.'/'.$FolderOrFile);
				else 
					unlink($dir.'/'.$FolderOrFile);
		closedir($handle); 
		if(rmdir($dir)) 
	  		$success = true;
		return $success; 
	}
	
	/* Evidenzia le parole in un oggetto contenente un contenuto (news, pagine, commenti...) */
	public function highlightContent($content, $highlight) {
		if(empty($content))
			return false;
		for($i=0, $count=count($content); $i<$count; ++$i)
			$content[$i]->contenuto = str_ireplace($highlight, '<font color="yellow">'.$highlight.'</font>', $content[$i]->contenuto);
		return $content;
	}
	
	/* Effettua una conversione byte->Megabyte. */
	public function byteToMega($byte) {
		return number_format($byte/1048576, 6); // In questo modo prendo pure i byte :)
	}
	
	/* Avvia il download di un file in modalità binaria. */
	public function downloadFile($file, $filename) {
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header('Content-Length: '.filesize($file));
		header('Content-type: '.finfo_file(finfo_open(FILEINFO_MIME), $file));
		header('Content-Disposition: attachment; filename='.$filename);
		header("Content-Transfer-Encoding: binary");
		readfile($file);
	}

	/* Converte la formattazione della data italiana in quella inglese. */
	public function dataToDate($data) {
		$date = explode('-', $data);
		return $date[1].'-'.$date[0].'-'.$date[2];
	}

	/* Ritorna il MIME type di un file.. */
	public function getMime($file) {
		$info = finfo_file(finfo_open(FILEINFO_MIME), $file);
		$array = explode(';', $info);
		return $array[0];
	}

	/* Ritorna true se è un file locale è di testo. */
	public function is_text($file) {
		return substr(finfo_file(finfo_open(FILEINFO_MIME), $file), 0, 4) == 'text';
	}

	/* Ritorna true se è un file locale è un'immagine. */
	public function is_image($file) {
		return substr(finfo_file(finfo_open(FILEINFO_MIME), $file), 0, 5) == 'image';
	}
}
