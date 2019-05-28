<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class AssetTest extends TestCase
{
    /** @var Asset $asset */
    protected $asset;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->asset = new Asset();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Asset',
                ],
                [
                    'id' => 2,
                    'name' => 'Test Asset 2',
                ]
            ]
        ]);

        $response = $this->asset->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_select_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Asset 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Test Asset 2',
                ]
            ]
        ]);

        $response = $this->asset->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'asset' => [],
                'activation_rule' => [],
                'expiration_rule' => [],
                'sku' => 'TEST_ASSET',
                'name' => 'Test Asset',
                'bin' => 100123,
                'algorithm' => 'luhn',
                'type' => 'physical',
                'reloadable' => true,
                'single_use' => false
            ]
        ]);

        $response = $this->asset->create([
            'id' => 1,
            'asset_id' => 1,
            'activation_rule_id' => 1,
            'expiration_rule_id' => 1,
            'sku' => 'TEST_ASSET',
            'name' => 'Test Asset',
            'bin' => 100123,
            'algorithm' => 'luhn',
            'type' => 'physical',
            'reloadable' => true,
            'single_use' => false
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'asset_id' => 1,
                'activation_rule_id' => 1,
                'expiration_rule_id' => 1,
                'sku' => 'TEST_ASSET',
                'name' => 'Test Asset',
                'bin' => 100123,
                'algorithm' => 'luhn',
                'type' => 'physical',
                'reloadable' => true,
                'single_use' => false
            ]
        ]);

        $response = $this->asset->update(1, [
            'name' => 'Updated Asset',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'asset_id' => 1,
                'activation_rule_id' => 1,
                'expiration_rule_id' => 1,
                'sku' => 'TEST_ASSET',
                'name' => 'Test Asset',
                'bin' => 100123,
                'algorithm' => 'luhn',
                'type' => 'physical',
                'reloadable' => true,
                'single_use' => false
            ]
        ]);

        $response = $this->asset->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}