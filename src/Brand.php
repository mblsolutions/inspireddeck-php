<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Brand extends ApiResource
{

    /**
     * View all Brands
     *
     * @return array
     */
    public function all(): array
    {
        return $this->getApiRequestor()->getRequest('brand');
    }

    /**
     * Create a new Brand
     *
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->getApiRequestor()->postRequest('brand', $params);
    }

    /**
     * Update a Brand
     *
     * @param array $params
     * @return array
     */
    public function update($id, array $params): array
    {
        return $this->getApiRequestor()->patchRequest('brand/' . $id, $params);
    }

    /**
     * Can Delete a Brand
     *
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->getApiRequestor()->patchRequest('brand/' . $id);
    }

}