<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class BulkTransaction extends ApiResource
{

    /**
     * View all Brands
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/bulk/transaction', [
            'page' => $page
        ]);
    }

    /**
     * Create a New Bulk Transaction
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/bulk/transaction', $params);
    }

}