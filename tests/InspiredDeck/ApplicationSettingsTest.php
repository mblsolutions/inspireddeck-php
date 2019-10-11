<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\ApplicationSettings;
use MBLSolutions\InspiredDeck\Brand;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ApplicationSettingsTest extends TestCase
{
    /** @var ApplicationSettings $settings */
    protected $settings;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->settings = new ApplicationSettings();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'help_find' => 'Updated Quick Start Find Code',
                'help_transaction' => 'Updated Quick Start Transaction',
                'help_report' => 'Updated Quick Start Report',
                'privacy_policy' => 'Updated Application Privacy Policy',
                'terms_of_service' => 'Updated Application Terms of Service'
            ]
        ]);

        $response = $this->settings->get();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'help_find' => 'Updated Quick Start Find Code',
            'help_transaction' => 'Updated Quick Start Transaction',
            'help_report' => 'Updated Quick Start Report',
            'privacy_policy' => 'Updated Application Privacy Policy',
            'terms_of_service' => 'Updated Application Terms of Service'
        ]);

        $response = $this->settings->update([
            'help_find' => 'Updated Quick Start Find Code',
            'help_transaction' => 'Updated Quick Start Transaction',
            'help_report' => 'Updated Quick Start Report',
            'privacy_policy' => 'Updated Application Privacy Policy',
            'terms_of_service' => 'Updated Application Terms of Service'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
}