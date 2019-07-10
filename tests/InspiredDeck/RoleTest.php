<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Role;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class RoleTest extends TestCase
{
    /** @var Role $role */
    protected $role;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->role = new Role();
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'PROGRAMME_MANAGER' => [
                    'id' => 'programme_manager',
                    'name' => 'Programme Manager',
                ],
                'CUSTOMER_SERVICE_MANAGER' => [
                    'id' => 'customer_service_manager',
                    'name' => 'Customer Service Manager',
                ],
                'CUSTOMER_SERVICE_OPERATOR' => [
                    'id' => 'customer_service_operator',
                    'name' => 'Customer Service Operator',
                ],
                'STORE_MANAGER' => [
                    'id' => 'store_manager',
                    'name' => 'Store Manager',
                ],
                'STORE_OPERATOR' => [
                    'id' => 'store_operator',
                    'name' => 'Store Operator',
                ],
                'REPORT' => [
                    'id' => 'report',
                    'name' => 'Report',
                ]
            ]
        ]);

        $response = $this->role->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}