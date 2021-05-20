<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Currency;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class CurrencyTest extends TestCase
{
    /** @var Currency $currency */
    protected $currency;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->currency = new Currency();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'name' => 'Pound Sterling',
                    'currency_code' => 'GBP',
                    'iso_numeric' => 826,
                ],
                [
                    'name' => 'Points',
                    'currency_code' => 'PNTS',
                    'iso_numeric' => null,
                ]
            ]
        ]);

        $response = $this->currency->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Pound Sterling',
                ],
                [
                    'id' => 2,
                    'name' => 'Points',
                ]
            ]
        ]);

        $response = $this->currency->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Pound Sterling',
            ]
        ]);

        $response = $this->currency->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'name' => 'Pound Sterling',
                'currency_code' => 'GBP',
                'iso_numeric' => 826,
            ]
        ]);

        $response = $this->currency->create([
            'name' => 'Pound Sterling',
            'currency_code' => 'GBP',
            'iso_numeric' => 826,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'name' => 'Updated Currency',
                'currency_code' => 'UDC',
                'iso_numeric' => 123,
            ]
        ]);

        $response = $this->currency->update(1, [
            'name' => 'Updated Currency',
            'currency_code' => 'UDC',
            'iso_numeric' => 123,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Pound Sterling',
                'currency_code' => 'GBP',
                'iso_numeric' => 826,
            ]
        ]);

        $response = $this->currency->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}