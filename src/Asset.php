<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Asset extends ApiResource
{

    /**
     * View all Assets
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/asset', [
            'page' => $page
        ]);
    }

    /**
     * Select Assets for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/asset/select');
    }

    /**
     * Create a new Asset
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/asset', $params);
    }

    /**
     * Update a Asset
     *
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/asset/' . $id, $params);
    }

    /**
     * Show a Asset
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/asset/' . $id);
    }

    /**
     * Can Delete a Asset
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/asset/' . $id);
    }

}