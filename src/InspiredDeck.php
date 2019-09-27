<?php

namespace MBLSolutions\InspiredDeck;

use MBLSolutions\InspiredDeck\Exceptions\MissingTokenException;

class InspiredDeck
{
    /** @var string $baseUri */
    private static $baseUri = 'https://inspireddeck.co.uk';

    /** @var string $token */
    private static $token;

    const AGENT = 'InspiredDeck-PHP';

    const VERSION = '1.0.1';

    /**
     * Override the default baseUri
     *
     * @param string $baseUri
     * @return void
     */
    public static function setBaseUri(string $baseUri = null): void
    {
        if ($baseUri) {
            self::$baseUri = $baseUri;
        }
    }

    /**
     * Get the Inspired Deck Base URI
     *
     * @return string
     */
    public static function getBaseUri(): string
    {
        return self::$baseUri;
    }

    /**
     * Set the Bearer Token
     *
     * @param string $token
     * @return void
     */
    public static function setToken(string $token)
    {
        self::$token = $token;
    }

    /**
     * Get the Bearer Token
     *
     * @return string
     * @throws MissingTokenException
     */
    public static function getToken(): string
    {
        $token = self::$token;

        if ($token === null) {
            throw new MissingTokenException('Missing Bearer Token in Inspired Deck Configuration');
        }

        return $token;
    }

}