<?php

namespace MBLSolutions\InspiredDeck\Tests\InspiredDeck\Exceptions;

use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;
use MBLSolutions\InspiredDeck\Tests\TestCase;

class AuthenticationExceptionTest extends TestCase
{

    /** @test **/
    public function json_message_is_decoded_into_the_response()
    {
        $body = json_encode([
            'message' => 'Enter the 6-digit code from your authenticator app.',
            'error' => 'two_factor_required',
        ]);

        $exception = new AuthenticationException($body, 422);

        $this->assertEquals($body, $exception->getMessage());
        $this->assertEquals(422, $exception->getCode());
        $this->assertEquals([
            'message' => 'Enter the 6-digit code from your authenticator app.',
            'error' => 'two_factor_required',
        ], $exception->getResponse());
        $this->assertEquals('two_factor_required', $exception->getError());
    }

    /** @test **/
    public function message_that_is_not_a_json_object_gives_an_empty_response()
    {
        foreach (['Client authentication failed', '', '1', '"text"', 'null'] as $message) {
            $exception = new AuthenticationException($message, 401);

            $this->assertEquals([], $exception->getResponse(), $message);
            $this->assertNull($exception->getError(), $message);
            $this->assertEquals($message, $exception->getMessage());
        }
    }

    /** @test **/
    public function exception_can_be_made_without_arguments()
    {
        $exception = new AuthenticationException();

        $this->assertEquals([], $exception->getResponse());
        $this->assertNull($exception->getError());
    }

    /** @test **/
    public function error_is_null_when_missing_or_not_a_string()
    {
        $this->assertNull((new AuthenticationException('{"message":"The user credentials were incorrect."}', 422))->getError());
        $this->assertNull((new AuthenticationException('{"message":"x","error":["a"]}', 422))->getError());
        $this->assertNull((new AuthenticationException('{"message":"x","error":5}', 422))->getError());
    }

    /** @test **/
    public function given_response_is_used_instead_of_the_message()
    {
        $exception = new AuthenticationException('Too many login attempts.', 429, null, [
            'message' => 'Too many login attempts.',
            'error' => 'too_many_attempts',
            'retry_after' => 60,
        ]);

        $this->assertEquals('Too many login attempts.', $exception->getMessage());
        $this->assertEquals('too_many_attempts', $exception->getError());
        $this->assertEquals(60, $exception->getResponse()['retry_after']);
    }

}
