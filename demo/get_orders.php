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
$api->setSubscriptionKey($options['order_subscription_key']);

$data = [
	'fetch_order_lines'  => true,
	'begin_modification_date'  => "2021-01-11T09:00:00",
	'end_modification_date' => "2022-01-01T09:00:00",
];

$rsp = $api->searchOrders($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);



$data = [
	'fetch_order_lines'  => true,
	'order_reference_list'  => ["2012011232REKPX"]
];

$rsp = $api->searchOrders($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);




$data = [
	'tracking_number'  => '',
	'carrier_name'  => '',
	'tracking_url'  => '',
	'order_line_list'  => [
		['seller_product_id'=>''],
		['seller_product_id'=>''],
		['seller_product_id'=>''],
	],
];

$rsp = $api->validateOrder('2012011232REKPX',$data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);