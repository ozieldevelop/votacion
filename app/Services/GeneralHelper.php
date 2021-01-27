<?php

namespace App\Services;

use  Illuminate\Support\Facades\Crypt;

class GeneralHelper {
	
	
	public function __construct()
	{

					//ddd("eds");

					$this->clave = 'Una cadena, muy, muy larga para mejorar la encriptacion';
					$this->method = 'aes-256-cbc';
					
					$this->iv = base64_decode("aZV4gIf0u1fr0xHfQO0k0w==");
	
	}

	public function encriptarx($valor ){
					return openssl_encrypt ($valor, $this->method, $this->clave, false, $this->iv);
	}

	public function desencriptarx($valor ){
			$encrypted_data = base64_decode($valor);
			 return openssl_decrypt($valor, $this->method, $this->clave, false, $this->iv);
	}
	
	/*
	public function getIV( ){
			 return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method)));
	}
	*/
	/*
	public function isDateBetweenDates(DateTime $date, DateTime $startDate, DateTime $endDate) {
			   return $date > $startDate && $date < $endDate;
	}
	*/

    static function func($expr, $bindParams = null)
    {
        return array("[F]" => array($expr, $bindParams));
    }


	static function getRealIP()
	{

		if (isset($_SERVER["HTTP_CLIENT_IP"]))

		{

			return $_SERVER["HTTP_CLIENT_IP"];

		}

		elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))

		{

			return $_SERVER["HTTP_X_FORWARDED_FOR"];

		}

		elseif (isset($_SERVER["HTTP_X_FORWARDED"]))

		{

			return $_SERVER["HTTP_X_FORWARDED"];

		}

		elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))

		{

			return $_SERVER["HTTP_FORWARDED_FOR"];

		}

		elseif (isset($_SERVER["HTTP_FORWARDED"]))

		{

			return $_SERVER["HTTP_FORWARDED"];

		}

		else
		{
			return $_SERVER["REMOTE_ADDR"];
		}

	}

 
 
 
 	static public function lara_encriptar($valor ){
			return Crypt::encryptString($valor);
	}

	static public function lara_desencriptar($valor ){
			return Crypt::decryptString($valor);
	}
	
	

}


?>