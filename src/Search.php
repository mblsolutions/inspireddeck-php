<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Search extends ApiResource
{

    /**
     * Select Actions for Input
     *
     * @param array $parameters
     * @return array
     */
    public function code(array $parameters = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/search/code', $parameters);
    }

}