<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class BrandTest extends TestCase
{
    /** @var Brand $brand */
    protected $brand;

    /** {@inheritdoc} **/
    public function setUp()
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

}