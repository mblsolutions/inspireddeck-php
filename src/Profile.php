<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Profile extends ApiResource
{

    /**
     * View all Profiles
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/profile', [
            'page' => $page
        ]);
    }

    /**
     * Create a new Profile
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/profile', $params);
    }

    /**
     * Update a Profile
     *
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/profile/' . $id, $params);
    }

    /**
     * Show a Profile
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/profile/' . $id);
    }

    /**
     * Can Delete a Profile
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/profile/' . $id);
    }

}