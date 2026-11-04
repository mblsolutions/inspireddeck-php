<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck;

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
