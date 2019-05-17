<?php

namespace MBLSolutions\InspiredDeck\Api;

use GuzzleHttp\Client;
use MBLSolutions\InspiredDeck\InspiredDeck;

abstract class OAuthResource extends ApiResource
{

    /**
     * Inspired Deck OAuth Resource
     */
    public function __construct()
    {
        parent::__construct();

        $client = new Client([
            'base_uri' => InspiredDeck::getBaseUri(),
        ]);

        $this->setApiRequestor(new ApiRequestor($client));
    }

}