<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck\Api;

use GuzzleHttp\Client;
use MBLSolutions\InspiredDeck\Api\ApiRequestor;
use MBLSolutions\InspiredDeck\Api\ApiResource;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ApiResourceTest extends TestCase
{
    
    /** @test **/
    public function can_get_api_requestor(): void
    {
        $stub = $this->getMockBuilder(ApiResource::class)
                     ->getMock();

        self::assertInstanceOf(ApiRequestor::class, $stub->getApiRequestor());
    }

    /** @test **/
    public function can_set_api_requestor(): void
    {
        $stub = $this->getMockBuilder(ApiResource::class)
                     ->getMock();

        $newApiRequestor = new ApiRequestor(new Client);

        self::assertInstanceOf(ApiRequestor::class, $stub->setApiRequestor($newApiRequestor));
    }

}