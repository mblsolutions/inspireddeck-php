<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use MBLSolutions\InspiredDeck\Api\ApiRequestor;
use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;
use MBLSolutions\InspiredDeck\Exceptions\PermissionDeniedException;
use MBLSolutions\InspiredDeck\Exceptions\ValidationException;
use MBLSolutions\InspiredDeck\Tests\Stubs\HttpResponseStubs;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class ApiRequestExceptionTest extends TestCase
{

    /** @test **/
    public function make_an_unauthorized_http_request()
    {
        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Unauthenticated.');
        $this->expectExceptionCode(401);

        $mockHandler = new MockHandler([
            HttpResponseStubs::unauthorized()
        ]);

        $this->mockMakeHttpRequest($mockHandler);
    }

    /** @test **/
    public function make_an_forbidden_http_request()
    {
        $this->expectException(PermissionDeniedException::class);
        $this->expectExceptionMessage('You do not have permission to access this resource.');
        $this->expectExceptionCode(403);

        $mockHandler = new MockHandler([
            HttpResponseStubs::forbidden()
        ]);

        $this->mockMakeHttpRequest($mockHandler);
    }

    /** @test **/
    public function make_an_unprocessable_entity_request()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');
        $this->expectExceptionCode(422);

        $mockHandler = new MockHandler([
            HttpResponseStubs::unprocessableEntity()
        ]);

        $this->mockMakeHttpRequest($mockHandler);
    }

    /**
     * Mock makeHttpRequest
     *
     * @param MockHandler $mockHandler
     * @return mixed
     * @throws mixed
     */
    protected function mockMakeHttpRequest(MockHandler $mockHandler)
    {
        $guzzle = new Client([
            'handler' => HandlerStack::create($mockHandler)
        ]);

        $reflection = new \ReflectionClass(ApiRequestor::class);

        $method = $reflection->getMethod('makeHttpRequest');
        $method->setAccessible(true);

        return $method->invoke(new ApiRequestor($guzzle), 'get', 'brand/1');
    }

}