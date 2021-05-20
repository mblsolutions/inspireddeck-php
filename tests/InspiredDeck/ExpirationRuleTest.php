<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\ExpirationRule;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ExpirationRuleTest extends TestCase
{
    /** @var ExpirationRule $expirationRule */
    protected $expirationRule;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->expirationRule = new ExpirationRule();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Expiration Rule 1',
                    'period' => 'hours',
                    'action' => 'issue',
                    'valid_to' => '2019-01-01 00:00:00'
                ],
                [
                    'id' => 2,
                    'name' => 'Expiration Rule 2',
                    'period' => 'hours',
                    'action' => 'issue',
                    'valid_to' => '2019-01-01 00:00:00'
                ]
            ]
        ]);

        $response = $this->expirationRule->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_select_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Expiration Rule 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Expiration Rule 2',
                ]
            ]
        ]);

        $response = $this->expirationRule->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Expiration Rule 1',
            ]
        ]);

        $response = $this->expirationRule->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Expiration Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_to' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->expirationRule->create([
            'name' => 'Test Expiration Rule',
            'period' => 'period',
            'action' => 'action',
            'valid_to' => '2019-01-01 00:00:00'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Expiration Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_to' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->expirationRule->update(1, [
            'name' => 'Updated Expiration Rule',
            'period' => 'hours',
            'action' => 'issue',
            'valid_to' => '2019-01-01 00:00:00'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Expiration Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_to' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->expirationRule->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}