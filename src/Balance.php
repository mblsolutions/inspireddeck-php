<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Balance extends ApiResource
{

    /**
     * Perform a Balance Check
     *
     * @param array $params
     * @return array
     */
    public function balance(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/balance', $params);
    }

}