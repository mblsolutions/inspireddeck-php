<?php

namespace MBLSolutions\InspiredDeck\Exceptions;

use Throwable;

class AuthenticationException extends \Exception
{
    /** @var array $response */
    protected $response;

    /**
     * Authentication Exception
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array|null $response decoded response body, read from the message when null
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null, ?array $response = null)
    {
        parent::__construct($message, $code, $previous);

        if ($response === null) {
            $decoded = json_decode($message, true);
            $response = is_array($decoded) ? $decoded : [];
        }

        $this->response = $response;
    }

    /**
     * Get the decoded response body
     *
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * Get the error code from the response body
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        $error = $this->response['error'] ?? null;

        return is_string($error) ? $error : null;
    }

}
