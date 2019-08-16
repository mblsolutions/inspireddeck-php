<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Report;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ReportTest extends TestCase
{
    /** @var Report $report */
    protected $report;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->report = new Report();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'id' => 1,
                ],
                [
                    'id' => 2,
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

        $response = $this->report->show(1, [
            'column_id' => 1
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_connection_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'mysql'
            ]
        ]);

        $response = $this->report->connections();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_middleware_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'MBLSolutions\Report\Middleware\HasAuthenticationGate'
            ]
        ]);

        $response = $this->report->middleware();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_data_type_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                '\MBLSolutions\Report\DataType\CastString::class',
                '\MBLSolutions\Report\DataType\CastUppercaseString::class',
            ]
        ]);

        $response = $this->report->dataType();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_get_model_list()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                '\App\User'
            ]
        ]);

        $response = $this->report->models();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_generate_an_export_report_uri(): void
    {
        $this->mockExpectedHttpResponse([
            'uri' => 'http://localhost/report/1/export?signature=7783a30'
        ]);

        $response = $this->report->export(1, [
            'status' => 'active'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }


}