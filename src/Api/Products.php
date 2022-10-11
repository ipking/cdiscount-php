<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Products extends Client {

  /**
  * Operation getCategories
   * @param array $query
  */
  public function getCategories($query=[])
  {
    return $this->send("/categories", [
      'method' => 'GET',
	   'query' => $query
    ]);
  }

}
