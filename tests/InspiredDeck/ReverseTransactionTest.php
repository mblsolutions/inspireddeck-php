<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\ReverseTransaction;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use MBLSolutions\InspiredDeck\Transfer;

class ReverseTransactionTest extends TestCase
{
    /** @var ReverseTransaction $debit */
    protected $reverseTransaction;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->reverseTransaction = new ReverseTransaction();
    }

    /** @test **/
    public function can_reverse_ransaction()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->reverseTransaction->reverse([
            'serial' => 12345678,
            'transaction_reference' => 'TRANS-REF-1',
            'reference' => 'TEST-REF-1'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}