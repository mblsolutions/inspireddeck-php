<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class TypeTest extends TestCase
{
    /** @var Type $type */
    protected $type;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->type = new Type();
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'PHYSICAL' => [
                    'id' => 'physical',
                    'name' => 'Physical'
                ],
                'DIGITAL' => [
                    'id' => 'digital',
                    'name' => 'Digital'
                ],
                'VOUCHER' => [
                    'id' => 'voucher',
                    'name' => 'Voucher'
                ]
            ]
        ]);

        $response = $this->type->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}