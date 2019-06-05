<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Debit extends ApiResource
{

    /**
     * Apply debit to a code
     *
     * @param array $params
     * @return array
     */
    public function debit(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/debit', $params);
    }

}