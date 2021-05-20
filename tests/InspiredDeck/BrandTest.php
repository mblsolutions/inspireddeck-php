<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Brand;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class BrandTest extends TestCase
{
    /** @var Brand $brand */
    protected $brand;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->brand = new Brand();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Brand 1',
                    'active' => true
                ],
                [
                    'id' => 2,
                    'name' => 'Test Brand 2',
                    'active' => true
                ]
            ]
        ]);

        $response = $this->brand->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Brand 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Test Brand 2',
                ]
            ]
        ]);

        $response = $this->brand->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Brand',
                'active' => true
            ]
        ]);

        $response = $this->brand->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Brand',
                'active' => true
            ]
        ]);

        $response = $this->brand->create([
            'name' => 'Test Brand',
            'active' => true,
            'programme_manager_name' => 'John Doe',
            'programme_manager_email' => 'john.doe@example.com'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Updated Brand',
                'active' => true
            ]
        ]);

        $response = $this->brand->update(1, [
            'name' => 'Updated Brand',
            'active' => true
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Brand',
                'active' => true
            ]
        ]);

        $response = $this->brand->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_resend_programme_activation(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'Test Brand',
                'active' => false
            ]
        ]);

        $response = $this->brand->resend(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }


    /** @test **/
    public function can_get_brand_users(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'role' => 'programme_manager',
                    'active' => true,
                    'brand' => [
                        'id' => 1,
                        'name' => 'Test Brand',
                        'active' => true
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'role' => 'programme_manager',
                    'active' => true,
                    'brand' => [
                        'id' => 1,
                        'name' => 'Test Brand',
                        'active' => true
                    ]
                ]
            ]
        ]);

        $response = $this->brand->users(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}