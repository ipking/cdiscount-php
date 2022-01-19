<?php



include '.config.php';

$cred = new \Cdiscount\Api\Token();
$cred->setClientId($options['client_id']);
$cred->setClientSecret($options['client_secret']);
$token = $cred->getAccessToken();
if(!$cred->isSuccess()){
	print_r($token);
	die();
}

$api = new \Cdiscount\Api\Sellers();
$api->setAccessToken($token['access_token']);
$api->setSellerId($options['seller_id']);
$api->setSubscriptionKey($options['seller_subscription_key']);

$rsp = $api->getSellerInformation();
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}

print_r($rsp);