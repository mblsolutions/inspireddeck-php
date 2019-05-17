<?php

namespace MBLSolutions\InspiredDeck\Api;

use GuzzleHttp\Exception\ClientException;
use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;
use MBLSolutions\InspiredDeck\Exceptions\PermissionDeniedException;
use MBLSolutions\InspiredDeck\Exceptions\ValidationException;

class HttpRequestError
{
    const HTTP_UNAUTHORIZED = 401;

    const HTTP_FORBIDDEN = 403;

    const HTTP_UNPROCESSABLE_ENTITY = 422;

    /**
     * Handle HTTP Client Request Error
     *
     * @param ClientException $exception
     */
    public static function handle(ClientException $exception)
    {
        if ($exception->getCode() === self::HTTP_UNAUTHORIZED) {
            static::throwException(AuthenticationException::class, $exception);
        }

        if ($exception->getCode() === self::HTTP_FORBIDDEN) {
            static::throwException(PermissionDeniedException::class, $exception);
        }

        if ($exception->getCode() === self::HTTP_UNPROCESSABLE_ENTITY) {
            static::throwException(ValidationException::class, $exception);
        }

        throw $exception;
    }

    /**
     * Throw an Exception
     *
     * @param string $type
     * @param $exception
     * @throws mixed
     */
    private static function throwException(string $type, ClientException $exception)
    {
        $response = $exception->getResponse();

        if ($response) {
            $message = $response->getBody()->getContents();
        }

        throw new $type($message ?? 'Received an empty response', $exception->getCode(), $exception->getPrevious());
    }

}