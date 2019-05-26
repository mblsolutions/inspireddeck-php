<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\TestCase;

class ActionTest extends TestCase
{
    /** @var Action $action */
    protected $action;

    /** {@inheritdoc} **/
    public function setUp()
    {
        parent::setUp();

        InspiredDeck::setToken('test_token');

        $this->action = new Action();
    }
    
    /** @test **/
    public function can_get_select_list(): void
    {
        $this->mockExpectedHttpResponse([
            'data' => [
                'ACTIVATION' => [
                    'id' => 'activation',
                    'name' => 'Activation'
                ],
                'BALANCE' => [
                    'id' => 'balance',
                    'name' => 'Balance'
                ],
                'CREDIT' => [
                    'id' => 'credit',
                    'name' => 'Credit'
                ],
                'DEBIT' => [
                    'id' => 'debit',
                    'name' => 'Debit'
                ],
                'IMPORT' => [
                    'id' => 'import',
                    'name' => 'Import'
                ],
                'ISSUE' => [
                    'id' => 'issue',
                    'name' => 'Issue'
                ]
            ]
        ]);

        $response = $this->action->select();

        $this->assertEquals($response, $this->getMockedResponseBody());
    }

}