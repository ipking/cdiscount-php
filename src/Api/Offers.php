<?php

namespace Cdiscount\Api;

use Cdiscount\Core\Client;

class Offers extends Client {

  /**
  * Operation searchOffers
  * @param array $query
  * @param array $body
  */
  public function searchOffers($query = [],$body = [])
  {
    return $this->send("/offers/search", [
      'method' => 'POST',
      'query' => $query,
      'json' => $body
    ]);
  }

}
