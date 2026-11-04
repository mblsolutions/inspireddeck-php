<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MBLSolutions\InspiredDeck\Api\ApiRequestor;
use MBLSolutions\InspiredDeck\Authentication;
use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;
use MBLSolutions\InspiredDeck\InspiredDeck;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /** @var Authentication $authentication */
    protected $authentication;

    /** {@inheritdoc} **/
    public function setUp(): void
    {
        parent::setUp();

        $this->authentication = new Authentication;
    }

    /** @test **/
    public function oauth_authenticate_using_password_grant()
    {
        $this->mockExpectedHttpResponse([
            'token_type' => 'Bearer',
            'expires_in' => 31622400,
            'access_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmOGMwNDAxZDAy',
            'refresh_token' => 'def5020002eca9ac7875d5d800c195024d7fb702535c0d30a0',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager'
            ]
        ]);

        $response = $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');

        $this->assertEquals([
            'token_type' => 'Bearer',
            'expires_in' => 31622400,
            'access_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmOGMwNDAxZDAy',
            'refresh_token' => 'def5020002eca9ac7875d5d800c195024d7fb702535c0d30a0',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager'
            ]
        ], $response);
    }

    /** @test */
    public function successful_oauth_password_grant_authentication_resets_bearer_token()
    {
        $this->mockExpectedHttpResponse([
            'token_type' => 'Bearer',
            'expires_in' => 31622400,
            'access_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmOGMwNDAxZDAy',
            'refresh_token' => 'def5020002eca9ac7875d5d800c195024d7fb702535c0d30a0',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager'
            ]
        ]);

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');

        $this->assertEquals('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmOGMwNDAxZDAy', InspiredDeck::getToken());

    }

    /** @test */
    public function oauth_password_grant_authentication_using_invalid_credentials()
    {
        $this->expectException(AuthenticationException::class);

        $this->expectExceptionCode(401);
        $this->expectExceptionMessage('The user credentials were incorrect.');

        $this->mockExpectedHttpResponse([
            'error' => 'invalid_credentials',
            'error_description' => 'The user credentials were incorrect.',
            'message' => 'The user credentials were incorrect.'
        ], 401);

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');
    }

    /** @test */
    public function oauth_password_grant_authentication_using_invalid_client()
    {
        $this->expectException(AuthenticationException::class);

        $this->expectExceptionCode(401);
        $this->expectExceptionMessage('Client authentication failed');

        $this->mockExpectedHttpResponse([
            'error' => 'invalid_client',
            'error_description' => 'Client authentication failed',
            'message' => 'Client authentication failed',
        ], 401);

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');
    }

    /** @test */
    public function password_grant_without_extra_fields_sends_the_same_body_as_before()
    {
        $this->mockExpectedHttpResponse($this->tokenResponse());

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');

        $this->assertSame([
            'grant_type' => 'password',
            'client_id' => 1,
            'client_secret' => 'auth-secret',
            'username' => 'john.doe@exmaple.com',
            'password' => 'password',
            'scope' => '',
        ], $this->getSentBody());
    }

    /** @test */
    public function password_grant_sends_an_otp()
    {
        $this->mockExpectedHttpResponse($this->tokenResponse());

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password', ['otp' => '123 456']);

        $this->assertSame('123 456', $this->getSentBody()['otp']);
        $this->assertArrayNotHasKey('recovery_code', $this->getSentBody());
    }

    /** @test */
    public function password_grant_sends_a_recovery_code()
    {
        $this->mockExpectedHttpResponse($this->tokenResponse());

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password', ['recovery_code' => 'abcde-12345']);

        $this->assertSame('abcde-12345', $this->getSentBody()['recovery_code']);
        $this->assertArrayNotHasKey('otp', $this->getSentBody());
    }

    /** @test */
    public function password_grant_skips_null_extra_fields()
    {
        $this->mockExpectedHttpResponse($this->tokenResponse());

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password', [
            'otp' => null,
            'recovery_code' => 'abcde-12345',
        ]);

        $this->assertArrayNotHasKey('otp', $this->getSentBody());
        $this->assertSame('abcde-12345', $this->getSentBody()['recovery_code']);
    }

    /** @test */
    public function password_grant_ignores_other_extra_fields()
    {
        $this->mockExpectedHttpResponse($this->tokenResponse());

        $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password', [
            'grant_type' => 'client_credentials',
            'client_id' => 9,
            'client_secret' => 'other',
            'username' => 'other@example.com',
            'password' => 'other',
            'scope' => '*',
            'foo' => 'bar',
        ]);

        $this->assertSame([
            'grant_type' => 'password',
            'client_id' => 1,
            'client_secret' => 'auth-secret',
            'username' => 'john.doe@exmaple.com',
            'password' => 'password',
            'scope' => '',
        ], $this->getSentBody());
    }

    /** @test */
    public function inactive_account_error_keeps_the_raw_body_as_message()
    {
        $body = ['message' => 'User invalid, must be active.', 'error' => 'account_inactive'];
        $this->mockExpectedHttpResponse($body, 401);

        $exception = $this->failedPassword();

        $this->assertEquals(401, $exception->getCode());
        $this->assertEquals(json_encode($body), $exception->getMessage());
        $this->assertEquals('account_inactive', $exception->getError());
        $this->assertEquals($body, $exception->getResponse());
    }

    /** @test */
    public function service_account_error_keeps_the_raw_body_as_message()
    {
        $body = ['message' => "This account can't sign in here.", 'error' => 'service_account'];
        $this->mockExpectedHttpResponse($body, 403);

        $exception = $this->failedPassword();

        $this->assertEquals(403, $exception->getCode());
        $this->assertEquals(json_encode($body), $exception->getMessage());
        $this->assertEquals('service_account', $exception->getError());
    }

    /** @test */
    public function wrong_password_keeps_the_message_text_and_has_no_error_code()
    {
        $this->mockExpectedHttpResponse(['message' => 'The user credentials were incorrect.'], 422);

        $exception = $this->failedPassword();

        $this->assertEquals(422, $exception->getCode());
        $this->assertEquals('The user credentials were incorrect.', $exception->getMessage());
        $this->assertNull($exception->getError());
        $this->assertEquals(['message' => 'The user credentials were incorrect.'], $exception->getResponse());
    }

    /** @test */
    public function login_step_errors_give_the_error_code_and_extras()
    {
        $twoFactor = [
            'secret' => 'JBSWY3DPEHPK3PXP',
            'otpauth_url' => 'otpauth://totp/InspiredDeck:john.doe%40example.com?secret=JBSWY3DPEHPK3PXP&issuer=InspiredDeck',
            'qr_svg' => '<svg xmlns="http://www.w3.org/2000/svg"></svg>',
        ];

        $cases = [
            ['message' => 'Your password must be changed.', 'error' => 'password_reset_required'],
            ['message' => 'Enter the 6-digit code from your authenticator app.', 'error' => 'two_factor_required'],
            ['message' => 'The provided two factor authentication code was invalid.', 'error' => 'invalid_two_factor_code'],
            ['message' => 'The provided two factor authentication code was invalid.', 'error' => 'invalid_two_factor_code', 'two_factor' => $twoFactor],
            ['message' => '2FA is now required. Set it up to continue using InspiredDeck.', 'error' => 'two_factor_setup_required', 'two_factor' => $twoFactor],
        ];

        foreach ($cases as $body) {
            $this->mockExpectedHttpResponse($body, 422);

            $exception = $this->failedPassword();

            $this->assertEquals(422, $exception->getCode());
            $this->assertEquals($body['message'], $exception->getMessage());
            $this->assertEquals($body['error'], $exception->getError());
            $this->assertEquals($body, $exception->getResponse());
        }
    }

    /** @test */
    public function too_many_attempts_passes_the_full_body_with_code_429()
    {
        $body = [
            'message' => 'Too many login attempts. Please try again in 60 seconds. This text is long enough to be cut short by the HTTP client summary.',
            'error' => 'too_many_attempts',
            'retry_after' => 60,
        ];
        $this->mockExpectedHttpResponse($body, 429);

        $exception = $this->failedPassword();

        $this->assertEquals(429, $exception->getCode());
        $this->assertEquals(json_encode($body), $exception->getMessage());
        $this->assertEquals('too_many_attempts', $exception->getError());
        $this->assertEquals(60, $exception->getResponse()['retry_after']);
    }

    /** @test */
    public function throttled_request_passes_the_body_with_code_429()
    {
        $this->mockExpectedHttpResponse(['message' => 'Too Many Attempts.'], 429);

        $exception = $this->failedPassword();

        $this->assertEquals(429, $exception->getCode());
        $this->assertEquals('{"message":"Too Many Attempts."}', $exception->getMessage());
        $this->assertNull($exception->getError());
    }

    /** @test */
    public function too_many_attempts_without_a_json_body_keeps_the_client_message()
    {
        foreach (['<html><body>Too Many Requests</body></html>', ''] as $body) {
            $this->mockRawHttpResponse(new Response(429, ['Content-Type' => 'text/html'], $body));

            $exception = $this->failedPassword();

            $this->assertEquals(429, $exception->getCode());
            $this->assertStringStartsWith('Client error', $exception->getMessage());
            $this->assertEquals([], $exception->getResponse());
        }
    }

    /** @test */
    public function other_client_errors_keep_the_client_message_and_give_the_body()
    {
        $this->mockExpectedHttpResponse(['message' => 'Bad request.', 'error' => 'invalid_request'], 400);

        $exception = $this->failedPassword();

        $this->assertEquals(400, $exception->getCode());
        $this->assertStringStartsWith('Client error', $exception->getMessage());
        $this->assertEquals('invalid_request', $exception->getError());
    }

    /** @test */
    public function server_errors_keep_the_server_message_and_give_the_body()
    {
        $this->mockExpectedHttpResponse(['message' => 'Server Error'], 500);

        $exception = $this->failedPassword();

        $this->assertEquals(500, $exception->getCode());
        $this->assertStringStartsWith('Server error', $exception->getMessage());
        $this->assertEquals(['message' => 'Server Error'], $exception->getResponse());
    }

    /** @test */
    public function request_errors_without_a_response_give_an_empty_body()
    {
        $this->mockRawHttpResponse(new RequestException('Request failed', new Request('POST', '/oauth/token')));

        $exception = $this->failedPassword();

        $this->assertEquals('Request failed', $exception->getMessage());
        $this->assertEquals([], $exception->getResponse());
    }

    /** @test */
    public function validation_errors_without_a_json_object_give_an_empty_body()
    {
        foreach (['Unprocessable', '1', '"text"'] as $body) {
            $this->mockRawHttpResponse(new Response(422, [], $body));

            $exception = $this->failedPassword();

            $this->assertEquals(422, $exception->getCode());
            $this->assertEquals($body, $exception->getMessage());
            $this->assertEquals([], $exception->getResponse());
        }
    }

    /**
     * Call the password grant and return the exception it throws
     *
     * @return AuthenticationException
     */
    private function failedPassword(): AuthenticationException
    {
        try {
            $this->authentication->password(1, 'auth-secret', 'john.doe@exmaple.com', 'password');
        } catch (AuthenticationException $exception) {
            return $exception;
        }

        $this->fail('AuthenticationException was not thrown');
    }

    /**
     * Mock the next HTTP response with a raw response or exception
     *
     * @param Response|RequestException $response
     */
    private function mockRawHttpResponse($response): void
    {
        ApiRequestor::setHttpClient(new Client([
            'handler' => HandlerStack::create(new MockHandler([$response])),
        ]));
    }

    /**
     * A successful token response
     *
     * @return array
     */
    private function tokenResponse(): array
    {
        return [
            'token_type' => 'Bearer',
            'expires_in' => 31622400,
            'access_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmOGMwNDAxZDAy',
            'refresh_token' => 'def5020002eca9ac7875d5d800c195024d7fb702535c0d30a0',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'programme_manager'
            ]
        ];
    }

    /**
     * Get the JSON body of the last sent request
     *
     * @return array
     */
    private function getSentBody(): array
    {
        return json_decode((string) $this->getMockedLastRequest()->getBody(), true);
    }

}
