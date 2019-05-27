<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Action extends ApiResource
{

    /**
     * Select Actions for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/action/select');
    }

    /**
     * Select Actions for Input
     *
     * @return array
     */
    public function activationSelect(): array
    {
        return $this->getApiRequestor()->getRequest('/api/action/activation-select');
    }

    /**
     * Select Actions for Input
     *
     * @return array
     */
    public function expirationSelect(): array
    {
        return $this->getApiRequestor()->getRequest('/api/action/expiration-select');
    }

}