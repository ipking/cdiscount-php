<?php

namespace Cdiscount\Core;

abstract class Client{
	
	const URI_API = 'https://api.octopia-io.net';
	
	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';
	const METHOD_PATCH = 'PATCH';
	
	protected static $callback;
	
	protected $method;
	
	protected $url;
	
	protected $client_response;
	
	protected $access_token;
	protected $seller_id;
	protected $subscription_key;
	
	protected $response_code;
	
	/**
	 * @param $cb
	 */
	public static function setSendCallback($cb){
		self::$callback = $cb;
	}
	
	
	/**
	 * @return string
	 */
	public function getMethod(){
		return $this->method;
	}
	
	/**
	 * @return string
	 */
	public function getUrl(){
		return $this->url;
	}
	
	/**
	 * @return string
	 */
	public function getResponse(){
		return $this->client_response;
	}
	
	
	/**
	 * @param $access_token
	 */
	public function setAccessToken($access_token){
		$this->access_token = $access_token;
	}
	
	/**
	 * @param $seller_id
	 */
	public function setSellerId($seller_id){
		$this->seller_id = $seller_id;
	}
	
	/**
	 * @param $subscription_key
	 */
	public function setSubscriptionKey($subscription_key){
		$this->subscription_key = $subscription_key;
	}

	
	/**
	 * @param string $uri
	 * @param array $requestOptions
	 * @return array
	 * @throws HttpException|\Exception
	 */
	protected function send($uri, $requestOptions = []){
		$this->method = strtoupper($requestOptions['method']);
		$this->url = self::URI_API.$uri;
		
		if (isset($requestOptions['query'])) {
			$this->url .= '?' . http_build_query($requestOptions['query']);
		}
		
		$header_arr = [];
		if($this->seller_id){
			$header_arr[] = 'SellerId: '.$this->seller_id;
		}
		if($this->subscription_key){
			$header_arr[] = 'Ocp-Apim-Subscription-Key: '.$this->subscription_key;
		}
		if($this->access_token){
			$header_arr[] = 'Authorization: Bearer '.$this->access_token;
		}
		$this->response_code = '';
		switch($this->method){
			case self::METHOD_GET:
				$opt = array(
					CURLOPT_HTTPHEADER     => $header_arr,
				);
				
				return $this->execute($this->url,$opt);
			case self::METHOD_POST:
				$data = [];
				if($requestOptions['json']){
					$data = json_encode($requestOptions['json']);
					$header_arr[] = 'Content-Type: application/json';
				}
				$opt = array(
					CURLOPT_POST           => true,
					CURLOPT_HTTPHEADER     => $header_arr,
					CURLOPT_POSTFIELDS     => $data,
				);
				return $this->execute($this->url,$opt);
			case self::METHOD_PATCH:
				$data = [];
				if($requestOptions['json']){
					$data = json_encode($requestOptions['json']);
					$header_arr[] = 'Content-Type: application/json';
				}
				$opt = array(
					CURLOPT_CUSTOMREQUEST  => self::METHOD_PATCH,
					CURLOPT_HTTPHEADER     => $header_arr,
					CURLOPT_POSTFIELDS     => $data,
				);
				return $this->execute($this->url,$opt);
			default :
				throw new \Exception('Not support method :'.$this->method);
		}
		
	}
	
	/**
	 * @param string $url
	 * @param array $opt
	 * @return array|mixed
	 * @throws HttpException
	 */
	public function execute($url, $opt){
		$this->response_code = '';
		$this->client_response = Curl::execute($url,$opt);
		list($response_body,$response_code) = $this->client_response;
		$this->response_code = $response_code;
		
		if(is_callable(self::$callback)){
			$callback = self::$callback;
			$callback($this);
		}
		
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
	
	/**
	 * @return bool
	 */
	public function isSuccess(){
		return $this->response_code == 200;
	}
}