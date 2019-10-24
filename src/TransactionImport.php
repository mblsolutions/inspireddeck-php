<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class TransactionImport extends ApiResource
{

    /**
     * View all Product Imports
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/transaction/import', [
            'page' => $page
        ]);
    }

    /**
     * Create a new Product Import
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/transaction/import', $params);
    }

    /**
     * Show a Product Import
     *
     * @param string $uuid
     * @return array
     */
    public function show(string $uuid): array
    {
        return $this->getApiRequestor()->getRequest('/api/transaction/import/' . $uuid);
    }

}