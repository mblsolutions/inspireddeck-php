<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class RegisteredBin extends ApiResource
{
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/registered-bin/select');
    }
}
