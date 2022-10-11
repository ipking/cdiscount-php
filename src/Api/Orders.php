<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Orders extends Client {

	/**
	* Operation searchOrders
	* @param array $query
	*/
	public function searchOrders($query = [])
	{
		return $this->send("/orders", [
			'method' => 'GET',
			'query' => $query
		]);
	}
	
	/**
	 * Operation validateOrder
	 * @param string $order_number
	 * @param array $body
	 */
	public function validateOrder($order_number,$body = [])
	{
		return $this->send("/orders/".$order_number."/shipments", [
			'method' => 'POST',
			'json' => $body
		]);
	}
}
