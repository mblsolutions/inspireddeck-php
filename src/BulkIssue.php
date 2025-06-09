<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class BulkIssue extends ApiResource
{

    /**
     * Apply credit to a code
     *
     * @param array $params
     * @return array
     */
    public function bulkIssue(array $params = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/bulk-issue', $params);
    }

}