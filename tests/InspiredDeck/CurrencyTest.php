<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class CurrencyTest extends TestCase
{
    /** @var Brand $currency */
    protected $currency;

    /** {@inheritdoc} **/
    public function setUp()
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