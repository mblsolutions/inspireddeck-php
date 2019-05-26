<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Algorithm extends ApiResource
{

    /**
     * Select Algorithms for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/algorithm/select');
    }

}