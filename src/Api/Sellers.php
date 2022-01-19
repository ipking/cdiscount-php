<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Sellers extends Client {

  /**
  * Operation getSellerInformation
  */
  public function getSellerInformation()
  {
    return $this->send("/sellerManagement/sellers", [
      'method' => 'GET',
    ]);
  }
}
