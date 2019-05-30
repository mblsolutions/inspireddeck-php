<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class AssetBatch extends ApiResource
{

    /**
     * View all Assets
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

}