<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class User extends ApiResource
{

    /**
     * View all Users
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/user', [
            'page' => $page
        ]);
    }

    /**
     * Create a new User
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/user', $params);
    }

    /**
     * Update a User
     *
     * @param $id
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/user/' . $id, $params);
    }

    /**
     * Show a User
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/user/' . $id);
    }

    /**
     * Can Delete a User
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/user/' . $id);
    }

    /**
     * Resend User Activation
     *
     * @param $id
     * @return array
     */
    public function resend($id): array
    {
        return $this->getApiRequestor()->postRequest('/api/user/' . $id . '/activation/resend');
    }

    /**
     * Deactivate a User
     *
     * @param $id
     * @return array
     */
    public function deactivate($id): array
    {
        return $this->getApiRequestor()->postRequest('/api/user/' . $id . '/deactivate');
    }

    /**
     * Request a Forgotten Password reset link
     *
     * @param array $params
     * @return array
     */
    public function forgottenPassword(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/password/forgot', $params, []);
    }



}