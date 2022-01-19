<?php



include '.config.php';

$cred = new \Cdiscount\Core\Token();
$cred->setClientId($options['client_id']);
$cred->setClientSecret($options['client_secret']);
$token = $cred->getAccessToken();
if(!$cred->isSuccess()){
	print_r($token);
	die();
}
$api = new \Cdiscount\Api\Products();
$api->setAccessToken($token['access_token']);
$api->setSellerId($options['seller_id']);
$api->setSubscriptionKey($options['product_subscription_key']);


$rsp = $api->getCategories();
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);
