<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Transfer extends ApiResource
{

    /**
     * Transfer a Code
     *
     * @param array $params
     * @return array
     */
    public function transfer(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/transfer', $params);
    }

}