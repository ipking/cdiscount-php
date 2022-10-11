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

$api = new \Cdiscount\Api\Orders();
$api->setAccessToken($token['access_token']);
$api->setSellerId($options['seller_id']);

$data = [
	'pageIndex'=>1,
	'pageSize'=>10,
	'updatedAtMin'  => "2021-01-11T09:00:00",
	'updatedAtMax' => "2022-01-01T09:00:00",
];

$rsp = $api->searchOrders($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);


$data = [
	'reference'=>'2101011234THLDJ',
];

$rsp = $api->searchOrders($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);


$data = [
	'parcelNumber'  => '34GFRTG43',
	'carrierName'  => 'Chronopost',
	'trackingUrl'  => 'www.trackingUrl.com/34GFRTG43',
	'orderLineIds'  => [
		"EO7E"
	],
];

$rsp = $api->validateOrder('2101011234THLDJ',[$data]);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);