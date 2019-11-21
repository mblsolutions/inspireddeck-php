<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class OAuthClient extends ApiResource
{

    /**
     * Show OAuth Clients
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/oauth/client', [
            'page' => $page
        ]);
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

    /**
     * Reset Client Secret
     *
     * @param $id
     * @return array
     */
    public function resetSecret($id): array
    {
        return $this->getApiRequestor()->postRequest('/api/oauth/client/' . $id . '/reset-secret');
    }

    /**
     * Reset Encryption Key for Client
     *
     * @param $id
     * @return array
     */
    public function resetEncryption($id): array
    {
        return $this->getApiRequestor()->postRequest('/api/oauth/client/' . $id . '/reset-encryption');
    }

    /**
     * Revoke all User tokens associated with Client
     *
     * @param $id
     * @return array
     */
    public function revokeToken($id): array
    {
        return $this->getApiRequestor()->postRequest('/api/oauth/client/' . $id . '/revoke-token');
    }

}