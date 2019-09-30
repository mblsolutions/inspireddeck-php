<?php

namespace MBLSolutions\InspiredDeck\Api;

use GuzzleHttp\Client;
use MBLSolutions\InspiredDeck\InspiredDeck;

abstract class ApiResource
{
    /** @var ApiRequestor $apiRequestor */
    private $apiRequestor;

    /**
     * Inspired Deck API Resource
     */
    public function __construct()
    {
        $client = new Client([
            'base_uri' => InspiredDeck::getBaseUri()
        ]);

        $this->apiRequestor = new ApiRequestor($client);
    }

    /**
     * Get an API Requestor Instance
     *
     * @return ApiRequestor
     */
    public function getApiRequestor(): ApiRequestor
    {
        return $this->apiRequestor;
    }

    /**
     * Set a new instance of the API Requestor
     *
     * @param ApiRequestor $apiRequestor
     * @return ApiRequestor
     */
    public function setApiRequestor(ApiRequestor $apiRequestor): ApiRequestor
    {
        $this->apiRequestor = $apiRequestor;

        return $this->apiRequestor;
    }

}