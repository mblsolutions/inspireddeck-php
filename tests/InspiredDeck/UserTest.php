<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Brand;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use MBLSolutions\InspiredDeck\User;

class UserTest extends TestCase
{
    /** @var Brand $user */
    protected $user;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->user = new User();
    }

    /** @test **/
    public function can_list_all()
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
                ]
            ]
        ]);

        $response = $this->user->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
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
            ]
        ]);

        $response = $this->user->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
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
            ]
        ]);

        $response = $this->user->create([
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
        ]);

        $response = $this->user->update(1, [
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
        ]);

        $response = $this->user->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_resend_activation(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager',
                'active' => false,
                'brand' => [
                    'id' => 1,
                    'name' => 'Test Brand',
                    'active' => false
                ]
            ]
        ]);

        $response = $this->user->resend(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_deactivate_user(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager',
                'active' => false,
                'brand' => [
                    'id' => 1,
                    'name' => 'Test Brand',
                    'active' => false
                ]
            ]
        ]);

        $response = $this->user->deactivate(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
    
    /** @test **/
    public function can_request_password_reset(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'email' => 'john.doe@example.org',
                'token' => 'abcd1234',
            ]
        ]);

        $response = $this->user->forgottenPassword([
            'email' => 'john.doe@example.org'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}