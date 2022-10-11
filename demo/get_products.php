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
$api = new \Cdiscount\Api\Products();
$api->setAccessToken($token['access_token']);
$api->setSellerId($options['seller_id']);


$data = [
	'pageIndex'=>1,
	'pageSize'=>10,
];

$rsp = $api->getCategories($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);
