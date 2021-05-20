<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class CustomerImport extends ApiResource
{

    /**
     * View customer Import
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/customer/import', [
            'page' => $page
        ]);
    }

    /**
     * Create a new customer Import
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/customer/import', $params);
    }

    /**
     * Get a customer Import template
     *
     * @param string $uuid
     * @return array
     */
    public function show(string $uuid): array
    {
        return $this->getApiRequestor()->getRequest('/api/customer/import/' . $uuid);
    }

}