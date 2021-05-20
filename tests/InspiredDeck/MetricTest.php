<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Metric;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class MetricTest extends TestCase
{
    /** @var Metric $metric */
    protected $metric;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->metric = new Metric();
    }

    /** @test **/
    public function can_get_dashboard_metrics()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                    'type' => 'balance'
                ],
                [
                    'id' => 1,
                    'type' => 'credit'
                ],
                [
                    'id' => 1,
                    'type' => 'debit'
                ]
            ]
        ]);

        $response = $this->metric->dashboard();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}