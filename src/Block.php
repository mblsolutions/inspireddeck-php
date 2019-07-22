<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Block extends ApiResource
{

    /**
     * Block to a code
     *
     * @param array $params
     * @return array
     */
    public function block(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/block', $params);
    }

}