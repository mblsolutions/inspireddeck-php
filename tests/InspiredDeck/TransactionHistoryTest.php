<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use MBLSolutions\InspiredDeck\TransactionHistory;

class TransactionHistoryTest extends TestCase
{
    /** @var TransactionHistory $transactionHistory */
    protected $transactionHistory;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->transactionHistory = new TransactionHistory();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'serial' => 1234567890,
                ],
                [
                    'serial' => 1234567890,
                ]
            ]
        ]);

        $response = $this->transactionHistory->all(1234567890);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_list_all_and_set_page()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'serial' => 1234567890,
                ],
                [
                    'serial' => 1234567890,
                ]
            ]
        ]);

        $response = $this->transactionHistory->all(1234567890, 0);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_list_all_and_set_limit()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'serial' => 1234567890,
                ],
                [
                    'serial' => 1234567890,
                ]
            ]
        ]);

        $response = $this->transactionHistory->all(1234567890, 0, 5);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}