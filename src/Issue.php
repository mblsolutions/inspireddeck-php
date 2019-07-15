<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Issue extends ApiResource
{

    /**
     * Apply credit to a code
     *
     * @param array $params
     * @return array
     */
    public function issue(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/issue', $params);
    }

}