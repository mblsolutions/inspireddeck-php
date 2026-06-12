<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Period extends ApiResource
{

    /**
     * Select Periods for Input
     *
     * @param string|null $context
     * @return array
     */
    public function select(?string $context = null): array
    {
        $params = $context ? ['context' => $context] : [];

        return $this->getApiRequestor()->getRequest('/api/period/select', $params);
    }

}