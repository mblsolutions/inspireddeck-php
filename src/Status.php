<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Status extends ApiResource
{

    /**
     * Select Statuses for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/status/select');
    }

}