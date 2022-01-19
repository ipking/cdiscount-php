<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Finances extends Client {

	/**
	* Operation getSellerPayments
	*/
	public function getSellerPayments()
	{
		return $this->send("/FinanceManagement/seller-payments", [
		  'method' => 'GET',
		]);
	}
	
	/**
	 * Operation searchesSellerPayments
	 * @param array $queryParams
	 * @param array $body
	 */
	public function searchesSellerPayments($queryParams = [],$body = [])
	{
		return $this->send("/FinanceManagement/seller-payments/search", [
			'method' => 'POST',
			'query' => $queryParams,
			'json' => $body,
		]);
	}
	
	/**
	 * Operation searchesSellerPaymentsDetails
	 * @param array $queryParams
	 * @param array $body
	 */
	public function searchesSellerPaymentsDetails($queryParams = [],$body = [])
	{
		return $this->send("/FinanceManagement/seller-payments-details/search", [
			'method' => 'POST',
			'query' => $queryParams,
			'json' => $body,
		]);
	}
}
