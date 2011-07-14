<?php
/*
 *	Easy Recaptcha : Basic class
 *	Abdelkader ELKALIDI | contact@updel.com
 *	More infos : https://www.google.com/recaptcha
 */
class ReCaptcha{
	public 		$theme		=	'red';
	public 		$lang		=	'en';
	public		$publicKey = '6LeeJ8YSAAAAAHZ0UNHwKdKuhUDNiZs6UTBq8zHX';
	public 		$privateKey = '6LeeJ8YSAAAAADKtKsRrlcKGqQ_W-4vN4fM4IBjd';
	public 		$messages	=	array(
									'invalid-site-private-key'	=>	'We weren\'t able to verify the private key.',
									'invalid-request-cookie'	=>	'The challenge parameter of the verify script was incorrect.',
									'incorrect-captcha-sol'		=>	'The CAPTCHA solution was incorrect.',
									'recaptcha-not-reachable'	=>	'reCAPTCHA never returns this error code. A plugin should manually return this code in the unlikely event that it is unable to contact the reCAPTCHA verify server.',
								);
	protected 	$error;
	protected 	$recaptchaServer 		= 	'http://www.google.com/recaptcha/api';
	protected 	$recaptchaSslServer 	= 	'https://www.google.com/recaptcha/api';
	protected 	$recaptchaCheckServer 	= 	'http://www.google.com/recaptcha/api/verify';

	/*
	 *	Nothing
	 */
	function __construct(){
	}

	/*
	 *	Debugger
	 */
	public function getError() {
		return !empty($this->error)	? $this->messages[$this->error] : false;
	}

	/*
	 *	Get Recaptcha
	 */
	public function getCaptcha($ssl = 0){
		$server	=	($ssl)	?	$this->recaptchaSslServer	:	$this->recaptchaServer;
		$error	=	(!$this->getError()) ? null : "&amp;error=" . $this->getError();
		$html	=	'
		<script type= "text/javascript">
			var RecaptchaOptions = {theme: \''.$this->theme.'\', lang : \''.$this->lang.'\'	};
		</script>
		<script type="text/javascript" src="'.$server.'/challenge?k='.$this->publicKey.$error.'"></script><noscript><iframe src="'.$server.'/noscript?k='.$this->publicKey.$error.'" height="300" width="500" frameborder="0"></iframe><br /><textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea><input type="hidden" name="recaptcha_response_field" value="manual_challenge"/></noscript>';
		return	$html;
	}

	/*
	 *	Check Recaptcha
	 */
	public function checkCaptcha(){
        $data 	= 	$this->getBySocket(
								$this->recaptchaCheckServer,
								array (
									'privatekey'	=> 	$this->privateKey,
									'remoteip'		=> 	$_SERVER["REMOTE_ADDR"],
									'challenge'		=> 	$_POST['recaptcha_challenge_field'],
									'response'		=> 	$_POST['recaptcha_response_field'],
								)
							);

        $array 			= 	explode("\n", $data);
		$this->error 	= 	(trim($array[0]) == 'false') ? trim($array[1]) : null;
	}

	/*
	 *	Send Data using Sockets
	 */
	private function getBySocket($url, $data) {
		$data		=	$this->concatData($data);
		$post	 	= 	curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_USERAGENT, $data);
		curl_setopt($post, CURLOPT_POST, 1);
		curl_setopt($post, CURLOPT_POSTFIELDS,$data);
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($post);
		curl_close($post);
		return $response;
	}

	/*
	 *	Concat Data
	 */
	private function concatData($data) {
		if(is_array($data)){
			foreach ($data as $key => $value){
				$var[]	= $key."=".$value;
			}
			return implode("&",$var);
		}
		else{
			return $data;
		}
	}
}

