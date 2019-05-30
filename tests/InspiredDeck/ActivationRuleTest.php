<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class ActivationRuleTest extends TestCase
{
    /** @var ActivationRule $activationRule */
    protected $activationRule;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->activationRule = new ActivationRule();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Activation Rule 1',
                    'period' => 'hours',
                    'action' => 'issue',
                    'valid_from' => '2019-01-01 00:00:00'
                ],
                [
                    'id' => 2,
                    'name' => 'Activation Rule 2',
                    'period' => 'hours',
                    'action' => 'issue',
                    'valid_from' => '2019-01-01 00:00:00'
                ]
            ]
        ]);

        $response = $this->activationRule->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_select_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Activation Rule 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Activation Rule 2',
                ]
            ]
        ]);

        $response = $this->activationRule->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Activation Rule 1',
            ]
        ]);

        $response = $this->activationRule->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Activation Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_from' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->activationRule->create([
            'name' => 'Test Activation Rule',
            'period' => 'period',
            'action' => 'action',
            'valid_from' => '2019-01-01 00:00:00'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Activation Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_from' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->activationRule->update(1, [
            'name' => 'Updated Activation Rule',
            'period' => 'hours',
            'action' => 'issue',
            'valid_from' => '2019-01-01 00:00:00'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Activation Rule',
                'period' => 'hours',
                'action' => 'issue',
                'valid_from' => '2019-01-01 00:00:00'
            ]
        ]);

        $response = $this->activationRule->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}