<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Brand;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\OAuthClient;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class OAuthClientTest extends TestCase
{
    /** @var Brand $client */
    protected $client;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->client = new OAuthClient();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Client',
                    'redirect' => null,
                    'revoked' => false
                ],
                [
                    'id' => 2,
                    'name' => 'Test Client 2',
                    'redirect' => null,
                    'revoked' => false
                ]
            ]
        ]);

        $response = $this->client->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Client',
                'redirect' => null,
                'revoked' => false
            ]
        ]);

        $response = $this->client->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Client',
                'secret' => '1234abcd',
                'redirect' => null,
                'revoked' => false
            ]
        ]);

        $response = $this->client->create([
            'name' => 'Test Client',
            'redirect' => null,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Client',
                'redirect' => null,
                'revoked' => false
            ]
        ]);

        $response = $this->client->update(1, [
            'name' => 'Test Client',
            'redirect' => null,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Client',
                'redirect' => null,
                'revoked' => true
            ]
        ]);

        $response = $this->client->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}