<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class ExpirationRule extends ApiResource
{

    /**
     * View all Expiration Rules
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/expiration-rule', [
            'page' => $page
        ]);
    }

    /**
     * Create a new Expiration Rule
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/expiration-rule', $params);
    }

    /**
     * Update a Expiration Rule
     *
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/expiration-rule/' . $id, $params);
    }

    /**
     * Show a Expiration Rule
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/expiration-rule/' . $id);
    }

    /**
     * Can Delete a Expiration Rule
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/expiration-rule/' . $id);
    }

}