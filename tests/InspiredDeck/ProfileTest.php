<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Profile;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ProfileTest extends TestCase
{
    /** @var Profile $profile */
    protected $profile;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->profile = new Profile();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Profile',
                ],
                [
                    'id' => 2,
                    'name' => 'Test Profile 2',
                ]
            ]
        ]);

        $response = $this->profile->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_select_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Profile',
                ],
                [
                    'id' => 2,
                    'name' => 'Test Profile 2',
                ]
            ]
        ]);

        $response = $this->profile->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Profile 1',
            ]
        ]);

        $response = $this->profile->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'brand' => [
                    'id' => 1,
                    'name' => 'Test Brand',
                    'active' => true
                ],
                'currency' => [
                    'id' => 1,
                    'name' => 'Pound Sterling',
                    'currency_code' => 'GBP',
                    'iso_numeric' => 826,
                ],
                'name' => 'Test Profile',
                'minimum_balance' => 0,
                'maximum_balance' => 100000,
                'maximum_credit' => 200000,
                'transactions_per_period' => 2,
                'transaction_limit_period' => 'hours',
                'transaction_rate_limit' => 60,
                'serial_start' => 10010000,
                'pin_length' => 4
            ]
        ]);

        $response = $this->profile->create([
            'brand_id' => 1,
            'currency_id' => 1,
            'name' => 'Test Profile',
            'minimum_balance' => 0,
            'maximum_balance' => 100000,
            'maximum_credit' => 200000,
            'transactions_per_period' => 2,
            'transaction_limit_period' => 'hours',
            'transaction_rate_limit' => 60,
            'serial_start' => 10010000,
            'pin_length' => 4
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'brand' => [
                    'id' => 1,
                    'name' => 'Test Brand',
                    'active' => true
                ],
                'currency' => [
                    'id' => 1,
                    'name' => 'Pound Sterling',
                    'currency_code' => 'GBP',
                    'iso_numeric' => 826,
                ],
                'name' => 'Test Profile',
                'minimum_balance' => 0,
                'maximum_balance' => 100000,
                'maximum_credit' => 200000,
                'transactions_per_period' => 2,
                'transaction_limit_period' => 'hours',
                'transaction_rate_limit' => 60,
                'serial_start' => 10010000,
                'pin_length' => 4
            ]
        ]);

        $response = $this->profile->update(1, [
            'name' => 'Updated Profile',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'brand' => [
                    'id' => 1,
                    'name' => 'Test Brand',
                    'active' => true
                ],
                'currency' => [
                    'id' => 1,
                    'name' => 'Pound Sterling',
                    'currency_code' => 'GBP',
                    'iso_numeric' => 826,
                ],
                'name' => 'Test Profile',
                'minimum_balance' => 0,
                'maximum_balance' => 100000,
                'maximum_credit' => 200000,
                'transactions_per_period' => 2,
                'transaction_limit_period' => 'hours',
                'transaction_rate_limit' => 60,
                'serial_start' => 10010000,
                'pin_length' => 4
            ]
        ]);

        $response = $this->profile->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}