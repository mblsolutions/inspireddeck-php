<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Search;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class SearchTest extends TestCase
{
    /** @var Search $search */
    protected $search;

    /** {@inheritdoc} **/
    public function setUp(): void
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