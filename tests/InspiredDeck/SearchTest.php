<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class SearchTest extends TestCase
{
    /** @var Search $search */
    protected $search;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->search = new Search();
    }
    
    /** @test **/
    public function can_search_for_code(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 123456789
            ]
        ]);

        $response = $this->search->code([
            'serial' => 123456789,
            'pan' => null,
            'customer' => null,
            'transaction' => null,
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}