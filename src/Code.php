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
     * Add funds to a code
     *
     * @param int $serial
     * @param int $amount
     * @return array
     */
    public function credit(int $serial, int $amount): array
    {
        return $this->getApiRequestor()->postRequest('/api/code/' . $serial . '/credit', [
            'amount' => $amount
        ]);
    }

    /**
     * Remove funds from a code
     *
     * @param int $serial
     * @param int $amount
     * @return array
     */
    public function debit(int $serial, int $amount): array
    {
        return $this->getApiRequestor()->postRequest('/api/code/' . $serial . '/debit', [
            'amount' => $amount
        ]);

    }
}