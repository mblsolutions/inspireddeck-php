<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class ReverseTransaction extends ApiResource
{

    /**
     * Transfer a Code
     *
     * @param array $params
     * @return array
     */
    public function reverse(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/reverse', $params);
    }

}