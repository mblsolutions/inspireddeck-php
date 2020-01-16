<?php

namespace MBLSolutions\InspiredDeck\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    /** @var $errors */
    protected $errors;

    /**
     * Throw a Validation Exception
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        $json = json_decode($message, true);

        if ($json) {
            $this->errors = $this->formatErrorDetails($json);
        }

        parent::__construct($json['message'] ?? $message, $code, $previous);
    }

    /**
     * Get Validation Errors
     *
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    /**
     * Format Error Details
     *
     * @param array $json
     * @return array|mixed
     */
    private function formatErrorDetails(array $json = [])
    {
        return $json['errors'] ?? ['message' => [$json['message']]];
    }

}