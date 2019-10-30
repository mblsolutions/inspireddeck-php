<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\AssetBatch;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class AssetBatchTest extends TestCase
{
    /** @var AssetBatch $assetBatch */
    protected $assetBatch;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->assetBatch = new AssetBatch();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                ],
                [
                    'id' => 2,
                ]
            ]
        ]);

        $response = $this->assetBatch->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show_asset_batch()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'serial' => 1234567890,
                ],
                [
                    'serial' => 1234567891,
                ]
            ]
        ]);

        $response = $this->assetBatch->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function export(): void
    {
        $this->mockExpectedHttpResponse([
            'uri' => 'https://localhost/asset-batch/1/export?expires=60&signature=1234abcd'
        ]);

        $response = $this->assetBatch->export(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}