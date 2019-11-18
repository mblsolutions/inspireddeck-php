<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class OAuthClient extends ApiResource
{

    /**
     * Show OAuth Clients
     *
     * @return array
     */
    public function all(): array
    {
        return $this->getApiRequestor()->getRequest('/api/oauth/client');
    }

    /**
     * Create an OAuth Client
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/oauth/client', $params);
    }

    /**
     * Update an OAuth Client
     *
     * @param $id
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/oauth/client/' . $id, $params);
    }

    /**
     * Show an OAuth Client
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/oauth/client/' . $id);
    }

    /**
     * Delete an OAuth Client
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/oauth/client/' . $id);
    }
    
}