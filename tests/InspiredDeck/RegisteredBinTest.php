<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\RegisteredBin;
use MBLSolutions\InspiredDeck\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RegisteredBinTest extends TestCase
{
    /** @var RegisteredBin $registeredBin */
    protected $registeredBin;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->registeredBin = new RegisteredBin();
    }

    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                '12345678' => [
                    'id' => '12345678',
                    'name' => 'test 1 (12345678)'
                ],
                '87654321' => [
                    'id' => '87654321',
                    'name' => 'test 2 (87654321)'
                ],
            ]
        ]);

        $response = $this->registeredBin->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }
}
