<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Credit extends ApiResource
{

    /**
     * Apply credit to a code
     *
     * @param array $params
     * @return array
     */
    public function credit(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/credit', $params);
    }

}