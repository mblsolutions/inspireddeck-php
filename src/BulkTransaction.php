<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class BulkTransaction extends ApiResource
{

    /**
     * Bulk Transaction Index
     *
     * @param int|null $page
     * @param int|null $limit
     * @return array
     */
    public function all(int $page = null, int $limit = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/bulk/transaction', [
            'page' => $page,
            'limit' => $limit
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

    /**
     * Show Bulk Transaction
     *
     * @param string $id
     * @return array
     */
    public function show(string $id): array
    {
        return $this->getApiRequestor()->postRequest('/api/bulk/transaction/' . $id);
    }

    /**
     * Generate Bulk Transaction Export Link(s)
     *
     * @param string $id
     * @return array
     */
    public function export(string $id): array
    {
        return $this->getApiRequestor()->postRequest('/api/bulk/transaction/' . $id . '/export');
    }

}