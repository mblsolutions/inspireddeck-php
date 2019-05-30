<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

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