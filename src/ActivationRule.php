<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class ActivationRule extends ApiResource
{

    /**
     * View all Activation Rules
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/activation-rule', [
            'page' => $page
        ]);
    }

    /**
     * Select Activation Rules for Input
     *
     * @return array
     */
    public function select(): array
    {
        return $this->getApiRequestor()->getRequest('/api/activation-rule/select');
    }

    /**
     * Create a new Activation Rule
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/activation-rule', $params);
    }

    /**
     * Update a Activation Rule
     *
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('/api/activation-rule/' . $id, $params);
    }

    /**
     * Show a Activation Rule
     *
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return $this->getApiRequestor()->getRequest('/api/activation-rule/' . $id);
    }

    /**
     * Can Delete a Activation Rule
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->deleteRequest('/api/activation-rule/' . $id);
    }

}