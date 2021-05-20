<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Balance;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class BalanceTest extends TestCase
{
    /** @var Balance balance */
    protected $balance;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->balance = new Balance();
    }

    /** @test **/
    public function can_perform_a_balance_check()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'balance' => 1000
            ]
        ]);

        $response = $this->balance->balance([
            'serial' => 1234567890
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}