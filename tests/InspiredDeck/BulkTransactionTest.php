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
    public function setUp(): void
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
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'uuid' => 'd1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                'key' => 'tmp/d1778bd4-89ca-4d02-9c30-d1e7ca0688a4',
                'name' => 'Batch_card_issue.csv',
                'content_type' => 'text/csv'
            ]
        ]);

        $response = $this->bulk->show('d1778bd4-89ca-4d02-9c30-d1e7ca0688a4');

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_export(): void
    {
        $this->mockExpectedHttpResponse([
            'uri' => 'https://localhost/bulk/d1778bd4-89ca-4d02-9c30-d1e7ca0688a4/export?expires=60&signature=1234abcd'
        ]);

        $response = $this->bulk->export('d1778bd4-89ca-4d02-9c30-d1e7ca0688a4');

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
    
    /** @test **/
    public function can_get_metrics(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'pending' => 1,
                'processing' => 1,
                'completed' => 1,
                'total' => 3
            ]
        ]);

        $response = $this->bulk->metrics();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}