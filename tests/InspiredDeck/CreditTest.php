<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Credit;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class CreditTest extends TestCase
{
    /** @var Credit $credit */
    protected $credit;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->credit = new Credit();
    }

    /** @test **/
    public function can_credit_code()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->credit->credit([
            'serial' => 12345678,
            'amount' => 100,
            'reference' => 'TEST-REF-1'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}