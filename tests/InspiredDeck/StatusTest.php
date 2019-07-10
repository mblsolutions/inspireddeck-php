<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Status;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class StatusTest extends TestCase
{
    /** @var Status $status */
    protected $status;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->status = new Status;
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'INACTIVE' => [
                    'id' => 'inactive',
                    'name' => 'Inactive'
                ],
                'ACTIVE' => [
                    'id' => 'active',
                    'name' => 'Active'
                ],
                'EXPIRED' => [
                    'id' => 'expired',
                    'name' => 'Expired'
                ],
                'BLOCKED' => [
                    'id' => 'blocked',
                    'name' => 'Blocked'
                ],
                'REDEEMED' => [
                    'id' => 'redeemed',
                    'name' => 'Redeemed'
                ]
            ]
        ]);

        $response = $this->status->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}