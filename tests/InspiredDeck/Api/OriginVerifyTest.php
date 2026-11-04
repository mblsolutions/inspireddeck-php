<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MBLSolutions\InspiredDeck\Api\ApiRequestor;
use MBLSolutions\InspiredDeck\Authentication;
use MBLSolutions\InspiredDeck\InspiredDeck;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class OriginVerifyTest extends TestCase
{
    protected function tearDown(): void
    {
        InspiredDeck::setOriginVerify(null);

        parent::tearDown();
    }

    #[Test]
    #[TestDox('Every HTTP method sends the configured origin header with default and custom headers')]
    public function testOriginVerifyIsSentOnEveryRequest(): void
    {
        $secret = bin2hex(random_bytes(32));
        $token = bin2hex(random_bytes(32));
        InspiredDeck::setOriginVerify($secret);
        InspiredDeck::setToken($token);

        foreach (['getRequest', 'postRequest', 'patchRequest', 'deleteRequest'] as $method) {
            foreach ([null, ['X-Custom' => 'example', 'x-origin-verify' => 'ignored']] as $headers) {
                $mock = new MockHandler([new Response(200, [], '{}')]);
                $requestor = new ApiRequestor(new Client(['handler' => HandlerStack::create($mock)]));

                $requestor->$method('https://api.example.test/resource', [], $headers);

                $request = $mock->getLastRequest();
                $this->assertSame([$secret], $request->getHeader('X-Origin-Verify'));
                $this->assertSame('application/json', $request->getHeaderLine('Accept'));
                $this->assertSame(
                    $headers === null ? 'Bearer ' . $token : '',
                    $request->getHeaderLine('Authorization')
                );

                if ($headers !== null) {
                    $this->assertSame('example', $request->getHeaderLine('X-Custom'));
                }
            }
        }
    }

    #[Test]
    #[TestDox('Missing and empty origin configuration omit the header, including after clearing a previous value')]
    public function testOriginVerifyCanBeUpdatedAndCleared(): void
    {
        $requestor = new ApiRequestor(new Client);

        foreach ([bin2hex(random_bytes(32)), '0', null, ''] as $value) {
            InspiredDeck::setOriginVerify($value);
            $mock = new MockHandler([new Response(200, [], '{}')]);
            ApiRequestor::setHttpClient(new Client(['handler' => HandlerStack::create($mock)]));

            $requestor->getRequest('https://api.example.test/resource', [], []);

            $request = $mock->getLastRequest();
            $this->assertSame($value !== null && $value !== '', $request->hasHeader('X-Origin-Verify'));
            $this->assertSame($value ?? '', $request->getHeaderLine('X-Origin-Verify'));
        }
    }

    #[Test]
    #[TestDox('OAuth token requests send origin verification without requiring a bearer token')]
    public function testOriginVerifyIsSentForOAuth(): void
    {
        $secret = bin2hex(random_bytes(32));
        InspiredDeck::setOriginVerify($secret);
        $authentication = new Authentication;
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => bin2hex(random_bytes(32))])),
        ]);
        ApiRequestor::setHttpClient(new Client(['handler' => HandlerStack::create($mock)]));

        $authentication->password(1, bin2hex(random_bytes(32)), 'user@example.test', 'password');

        $request = $mock->getLastRequest();
        $this->assertSame('/oauth/token', $request->getUri()->getPath());
        $this->assertSame($secret, $request->getHeaderLine('X-Origin-Verify'));
        $this->assertFalse($request->hasHeader('Authorization'));
    }

    #[Test]
    #[TestDox('Requests carrying the origin secret never follow redirects to another endpoint')]
    public function testOriginVerifyIsNotForwardedByRedirects(): void
    {
        InspiredDeck::setOriginVerify(bin2hex(random_bytes(32)));
        $mock = new MockHandler([
            new Response(302, ['Location' => 'https://other.example.test/'], '{}'),
            new Response(200, [], '{}'),
        ]);
        $requestor = new ApiRequestor(new Client(['handler' => HandlerStack::create($mock)]));

        $requestor->getRequest('https://api.example.test/resource', [], []);

        $this->assertCount(1, $mock);
        $this->assertSame('api.example.test', $mock->getLastRequest()->getUri()->getHost());
    }
}
