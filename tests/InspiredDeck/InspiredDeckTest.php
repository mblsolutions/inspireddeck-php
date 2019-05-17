<?php

namespace MBLSolutions\InspiredDeck\Tests;

use MBLSolutions\InspiredDeck\Exceptions\MissingTokenException;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\TestCase;

class InspiredDeckTest extends TestCase
{

    /** @test **/
    public function can_get_package_version()
    {
        $this->assertEquals('1.0.0', InspiredDeck::VERSION);
    }

    /** @test **/
    public function can_get_package_agent()
    {
        $this->assertEquals('InspiredDeck-PHP', InspiredDeck::AGENT);
    }

    /** @test **/
    public function can_get_base_ur()
    {
        $this->assertEquals('https://inspireddeck.co.uk', InspiredDeck::getBaseUri());
    }

    /** @test **/
    public function can_override_the_base_uri()
    {
        InspiredDeck::setBaseUri('http://localhost');

        $this->assertEquals('http://localhost', InspiredDeck::getBaseUri());
    }

    /** @test **/
    public function can_set_bearer_token()
    {
        InspiredDeck::setToken('test_token');

        $this->assertEquals('test_token', InspiredDeck::getToken());
    }

    /** @test **/
    public function can_set_a_new_bearer_token()
    {
        InspiredDeck::setToken('new_test_token');

        $this->assertEquals('new_test_token', InspiredDeck::getToken());
    }

    /** @test **/
    public function exception_thrown_if_retrieving_bearer_token_that_is_set_to_null()
    {
        $this->expectException(MissingTokenException::class);

        $this->unsetInspiredDeckProperty('token');

        InspiredDeck::getToken();
    }

}