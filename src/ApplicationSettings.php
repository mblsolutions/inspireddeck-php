<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Api\ApiResource;

class ApplicationSettings extends ApiResource
{

    /**
     * Get Settings

     * @return array
     */
    public function get(): array
    {
        return $this->getApiRequestor()->getRequest('/api/settings');
    }

    /**
     * Update Settings
     *
     * @param array $data
     * @return array
     */
    public function update(array $data): array
    {
        return $this->getApiRequestor()->patchRequest('/api/settings', $data);
    }

}