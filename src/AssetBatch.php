<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class AssetBatch extends ApiResource
{

    /**
     * View all Asset Batches
     *
     * @param int|null $page
     * @return array
     */
    public function all(int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/asset-batch', [
            'page' => $page
        ]);
    }

    /**
     * Show Asset Batch Codes
     *
     * @param int $id
     * @param int|null $page
     * @return array
     */
    public function show(int $id, int $page = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/asset-batch/' . $id, [
            'page' => $page
        ]);
    }

}