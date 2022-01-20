<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Orders extends Client {

	/**
	* Operation searchOrders
	* @param array $body
	*/
	public function searchOrders($body = [])
	{
		return $this->send("/OrderManagement/orders/search", [
		  'method' => 'POST',
		  'json' => $body
		]);
	}
	
	/**
	 * Operation validateOrder
	 * @param string $order_number
	 * @param array $body
	 */
	public function validateOrder($order_number,$body = [])
	{
		return $this->send("/OrderManagement/orders/".$order_number."/validate", [
			'method' => 'PATCH',
			'json' => $body
		]);
	}
}
