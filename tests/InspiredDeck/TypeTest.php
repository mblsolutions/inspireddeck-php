<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use MBLSolutions\InspiredDeck\Type;

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