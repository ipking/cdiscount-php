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

$api = new \Cdiscount\Api\Finances();
$api->setAccessToken($token['access_token']);
$api->setSellerId($options['seller_id']);

$query = [
	'pageIndex'=>1,
	'pageSize'=>10,
	'paidAtMin'=>"2021-11-11T09:00:00",
	'paidAtMax'=>"2022-01-11T09:00:00",
];
$rsp = $api->getPayments($query);

if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);

$query = [
	'pageIndex'=>1,
	'pageSize'=>10,
	'paidAtMin'=>"2021-11-11T09:00:00",
	'paidAtMax'=>"2022-02-11T09:00:00",
	//"orderReference"=>"2101011234THLDJ"
];


$rsp = $api->getOperations($query);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);