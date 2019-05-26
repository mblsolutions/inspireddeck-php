<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class PeriodTest extends TestCase
{
    /** @var Period $period */
    protected $period;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->period = new Period();
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'SECONDS' => [
                    'id' => 'seconds',
                    'name' => 'Seconds'
                ],
                'MINUTES' => [
                    'id' => 'minutes',
                    'name' => 'Minutes'
                ],
                'HOURS' => [
                    'id' => 'hours',
                    'name' => 'Hours'
                ],
                'DAYS' => [
                    'id' => 'days',
                    'name' => 'Days'
                ],
                'WEEKS' => [
                    'id' => 'weeks',
                    'name' => 'Weeks'
                ],
                'YEARS' => [
                    'id' => 'years',
                    'name' => 'Years'
                ]
            ]
        ]);

        $response = $this->period->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}