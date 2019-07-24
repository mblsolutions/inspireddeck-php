<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class TransactionHistory extends ApiResource
{

    /**
     * View all Assets
     *
     * @param int $serial
     * @param int|null $page
     * @param int $limit
     * @return array
     */
    public function all(int $serial, int $page = null, $limit = null): array
    {
        return $this->getApiRequestor()->getRequest('/api/transaction/' . $serial, [
            'page' => $page,
            'limit' => $limit
        ]);
    }

}