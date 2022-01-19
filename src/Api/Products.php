<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Products extends Client {

  /**
  * Operation getCategories
  */
  public function getCategories()
  {
    return $this->send("/productManagement/categories", [
      'method' => 'GET'
    ]);
  }

}
