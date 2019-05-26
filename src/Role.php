<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Role extends ApiResource
{

    /**
     * Select Roles for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/role/select');
    }

}