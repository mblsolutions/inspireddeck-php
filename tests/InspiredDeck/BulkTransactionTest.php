<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Brand;
use MBLSolutions\InspiredDeck\BulkTransaction;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class BulkTransactionTest extends TestCase
{
    /** @var Brand $bulk */
    protected $bulk;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->bulk = new BulkTransaction;
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'uuid' => 'd1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                    'key' => 'tmp/d1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                    'name' => 'Batch_card_issue.csv',
                    'content_type' => 'text/csv'
                ]
            ]
        ]);

        $response = $this->bulk->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'uuid' => 'd1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                'key' => 'tmp/d1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                'name' => 'Batch_card_issue.csv',
                'content_type' => 'text/csv'
            ]
        ]);

        $response = $this->bulk->create([
            'uuid' => 'd1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
            'key' => 'tmp/d1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
            'name' => 'Batch_card_issue.csv',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}