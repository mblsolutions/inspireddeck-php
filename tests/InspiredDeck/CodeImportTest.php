<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use MBLSolutions\InspiredDeck\CodeImport;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class CodeImportTest extends TestCase
{
    /** @var CodeImport $import */
    protected $import;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->import = new CodeImport();
    }

    /** @test **/
    public function can_list_all()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                [
                    'uuid' => '9c22ba3c-3583-499b-9d5e-dd7063f11740',
                    'key' => 'tmp/9c22ba3c-3583-499b-9d5e-dd7063f11740',
                    'bucket' => 'inspireddeck-staging',
                    'name' => 'Code Report_1570617877.csv',
                    'content_type' => 'text/csv'
                ]
            ]
        ]);

        $response = $this->import->all();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_show()
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'uuid' => '9c22ba3c-3583-499b-9d5e-dd7063f11740',
                'key' => 'tmp/9c22ba3c-3583-499b-9d5e-dd7063f11740',
                'bucket' => 'inspireddeck-staging',
                'name' => 'Code Report_1570617877.csv',
                'content_type' => 'text/csv'
            ]
        ]);

        $response = $this->import->show('9c22ba3c-3583-499b-9d5e-dd7063f11740');

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

    /** @test **/
    public function can_create()
    {
        $this->mockExpectedHttpResponse([
            'uuid' => '9c22ba3c-3583-499b-9d5e-dd7063f11740',
            'key' => 'tmp/9c22ba3c-3583-499b-9d5e-dd7063f11740',
            'bucket' => 'inspireddeck-staging',
            'name' => 'Code Report_1570617877.csv',
            'content_type' => 'text/csv'
        ], 201);

        $response = $this->import->create([
            'uuid' => '9c22ba3c-3583-499b-9d5e-dd7063f11740',
            'key' => 'tmp/9c22ba3c-3583-499b-9d5e-dd7063f11740',
            'bucket' => 'inspireddeck-staging',
            'name' => 'Code Report_1570617877.csv',
            'content_type' => 'text/csv'
        ]);

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}