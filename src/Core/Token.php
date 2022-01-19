<?php

namespace Cdiscount\Core;


class Token
{
	const URI_API = 'https://oauth2.cdiscount.com/auth/realms/maas-international-sellers/protocol/openid-connect/token';
	
    private $client_id;
    private $client_secret;
    private $response_code;
	
	/**
	 * @param string $client_id
	 */
	public function setClientId($client_id){
		$this->client_id = $client_id;
    }
	
	/**
	 * @param string $client_secret
	 */
	public function setClientSecret($client_secret){
		$this->client_secret = $client_secret;
	}
	
	/**
	 * @return bool
	 */
	public function isSuccess(){
		return $this->response_code == 200;
	}
	
	/**
	 * @return array
	 * @throws HttpException
	 */
	public function getAccessToken()
    {
	    $arr_data = [
		    'grant_type'    => 'client_credentials',
		    'client_id'     => $this->client_id,
		    'client_secret' => $this->client_secret,
	    ];
	    $this->response_code = '';
	    list($response_body,$response_code) = Curl::post(self::URI_API, $arr_data);
	    $this->response_code = $response_code;
	    if($response_code != 200 and !$response_body){
		    $error_map = [
			    400=>'Bad Request',
			    401=>'Unauthorized',
			    403=>'Forbidden',
			    404=>'Not Found',
		    ];
		    return [
			    'statusCode'=>$response_code,
			    'message'=>$error_map[$response_code]?:'Internal Server Error',
		    ];
	    }
	
	    return json_decode($response_body, true);
    }
    
}
