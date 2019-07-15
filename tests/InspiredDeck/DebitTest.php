<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Debit;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class DebitTest extends TestCase
{
    /** @var Debit $debit */
    protected $debit;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->debit = new Debit();
    }

    /** @test **/
    public function can_debit_code()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->debit->debit([
            'serial' => 12345678,
            'amount' => 100,
            'reference' => 'TEST-REF-1'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}