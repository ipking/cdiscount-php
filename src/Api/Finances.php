<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Finances extends Client {

	/**
	* Operation getPayments
	* @param array $query
	*/
	public function getPayments($query = [])
	{
		return $this->send("/payments", [
		  'method' => 'GET',
		  'query' => $query,
		]);
	}
	
	/**
	 * Operation getOperations
	 * @param array $query
	 */
	public function getOperations($query = [])
	{
		return $this->send("/operations", [
			'method' => 'GET',
			'query' => $query,
		]);
	}
}
