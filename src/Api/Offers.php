<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Offers extends Client {

  /**
  * Operation searchOffers
  * @param array $body
  */
  public function searchOffers($body = [])
  {
    return $this->send("/offerManagement/offers/search", [
      'method' => 'POST',
      'json' => $body
    ]);
  }

}
