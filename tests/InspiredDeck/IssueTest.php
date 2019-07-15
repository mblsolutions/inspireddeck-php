<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\Issue;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class IssueTest extends TestCase
{
    /** @var Issue $issue */
    protected $issue;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->issue = new Issue();
    }

    /** @test **/
    public function can_debit_code()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'serial' => 12345678,
            ]
        ]);

        $response = $this->issue->issue([
            'serial' => 12345678,
            'reference' => 'TEST-REF-1'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}