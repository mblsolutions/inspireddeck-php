<?php

namespace InspiredDeck;

use MBLSolutions\InspiredDeck\BulkIssue;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class BulkIssueTest extends TestCase
{
    /** @var BulkIssue $bulkIssue */
    protected $bulkIssue;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->bulkIssue = new BulkIssue();
    }

    /** @test **/
    public function can_debit_code()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->bulkIssue->bulkIssue([
            'sku' => 'TEST-SKU-GBP',
            'reference' => 'TEST-REF-1',
            'activate_immediately' => true,
            'quantity' => 10,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}