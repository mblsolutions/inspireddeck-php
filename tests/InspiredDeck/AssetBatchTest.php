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

}