<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class Code extends ApiResource
{

    /**
     * View all Assets
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/code', [
            'page' => $page
        ]);
    }

    /**
     * Create a new Asset
     *
     * @param int $asset_id
     * @param array $params
     * @return array
     */
    public function create(int $asset_id, array $params): array
    {
        return $this->getApiRequestor()->postRequest('/api/code/' . $asset_id, $params);
    }

    /**
     * Show a Code
     *
     * @param int $serial
     * @return array
     */
    public function show(int $serial): array
    {
        return $this->getApiRequestor()->getRequest('/api/code/' . $serial);
    }

    /**
     * Select Actions for Input
     *
     * @param array $parameters
     * @return array
     */
    public function search(array $parameters = []): array
    {
        return $this->getApiRequestor()->postRequest('/api/search/code', $parameters);
    }

    /**
     * Refresh Code data
     *
     * @param int $serial
     * @return array
     */
    public function refresh(int $serial): array
    {
        return $this->getApiRequestor()->getRequest('/api/refresh/' . $serial);
    }

}