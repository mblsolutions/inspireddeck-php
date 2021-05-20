<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\ApplicationSettings;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use MBLSolutions\InspiredDeck\UserSettings;

class UserSettingsTest extends TestCase
{
    /** @var ApplicationSettings $settings */
    protected $settings;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->settings = new UserSettings();
    }

    /** @test **/
    public function can_get_settings()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'brand' => 'Acme Inc.',
                'name' => 'John Doe',
                'email' => 'john.doe@example.org',
                'role' => 'Programme Manager'
            ]
        ]);

        $response = $this->settings->get();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update_settings(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'brand' => 'Acme Inc.',
                'name' => 'John Doe',
                'email' => 'john.doe@example.org',
                'role' => 'Programme Manager'
            ]
        ]);

        $response = $this->settings->update([
            'name' => 'John Doe',
            'email' => 'john.doe@example.org',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}