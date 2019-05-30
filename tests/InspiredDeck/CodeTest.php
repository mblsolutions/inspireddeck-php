<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class CodeTest extends TestCase
{
    /** @var Code $code */
    protected $code;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->code = new Code();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'serial' => 1,
                ],
                [
                    'serial' => 2,
                ]
            ]
        ]);

        $response = $this->code->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->code->show(12345678);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'message' => 'Code Generation Request Successful.'
        ], 202);

        $response = $this->code->create(1, [
            'quantity' => 1000,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}