<?php

namespace Cdiscount\Api;


use Cdiscount\Core\Client;

class Token extends Client{
	const URI_API = 'https://oauth2.cdiscount.com/auth/realms/maas-international-sellers/protocol/openid-connect/token';
	
    private $client_id;
    private $client_secret;
	
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
	 * @return array
	 */
	public function getAccessToken()
    {
	    $arr_data = [
		    'grant_type'    => 'client_credentials',
		    'client_id'     => $this->client_id,
		    'client_secret' => $this->client_secret,
	    ];
	    $arr_data = http_build_query($arr_data);
	    $opt = array(
		    CURLOPT_POST           => true,
		    CURLOPT_POSTFIELDS     => $arr_data,
	    );
	    return $this->execute(self::URI_API, $opt);
    }
    
}
