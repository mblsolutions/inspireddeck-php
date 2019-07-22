<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Block;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class BlockTest extends TestCase
{
    /** @var Block $debit */
    protected $block;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->block = new Block();
    }

    /** @test **/
    public function can_block_code()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->block->block([
            'serial' => 12345678,
            'reference' => 'TEST-REF-1'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}