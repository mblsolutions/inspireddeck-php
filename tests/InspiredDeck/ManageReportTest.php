<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\ManageReport;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ManageReportTest extends TestCase
{
    /** @var ManageReport $report */
    protected $report;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->report = new ManageReport();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1
                ],
                [
                    'id' => 2
                ]
            ]
        ]);

        $response = $this->report->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1
            ]
        ]);

        $response = $this->report->show(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1
            ]
        ]);

        $response = $this->report->create([
            'name' => 'Test Report',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_update()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1
            ]
        ]);

        $response = $this->report->update(1, [
            'name' => 'Updated Report',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_delete()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'id' => 1
            ]
        ]);

        $response = $this->report->delete(1);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_test()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'success' => true
            ]
        ]);

        $response = $this->report->test([
            'name' => 'Test Report',
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}