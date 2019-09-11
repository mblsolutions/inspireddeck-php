<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Metric extends ApiResource
{

    /**
     * Get Dashboard Metrics
     *
     * @return array
     */
    public function dashboard(): array
    {
        return $this->getApiRequestor()->getRequest('/api/metrics/dashboard');
    }

}