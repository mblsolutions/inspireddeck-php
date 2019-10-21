<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class CodeImport extends ApiResource
{

    /**
     * View all Product Imports
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/code/import', [
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
        return $this->getApiRequestor()->postRequest('/api/code/import', $params);
    }

    /**
     * Show a Product Import
     *
     * @param string $uuid
     * @return array
     */
    public function show(string $uuid): array
    {
        return $this->getApiRequestor()->getRequest('/api/code/import/' . $uuid);
    }

}