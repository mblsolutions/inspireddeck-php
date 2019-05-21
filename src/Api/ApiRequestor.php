<?php

namespace MBLSolutions\InspiredDeck\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use MBLSolutions\InspiredDeck\Exceptions\MissingTokenException;
use MBLSolutions\InspiredDeck\Exceptions\ValidationException;
use MBLSolutions\InspiredDeck\InspiredDeck;

class ApiRequestor
{
    /** @var ClientInterface $guzzle */
    private static $guzzle;

    /**
     * Create a new API Requestor Instance
     *
     * @param ClientInterface|null $guzzle
     */
    public function __construct(ClientInterface $guzzle)
    {
        self::$guzzle = $guzzle;
    }

    /**
     * Get the HTTP Client
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return self::$guzzle;
    }

    /**
     * Set the HTTP Client
     *
     * @param ClientInterface $guzzle
     */
    public static function setHttpClient(ClientInterface $guzzle)
    {
        self::$guzzle = $guzzle;
    }

    /**
     * Make a Get Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function getRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('get', $uri, [
            'headers' => $headers ?? $this->authenticatedHeaders(),
            'query' => $params
        ]);
    }

    /**
     * Make a Post Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function postRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('post', $uri, [
            'headers' => $headers ?? $this->authenticatedHeaders(),
            'form_params' => $params
        ]);
    }

    /**
     * Make a Patch Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function patchRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('patch', $uri, [
            'headers' => $headers ?? $this->authenticatedHeaders(),
            'form_params' => $params
        ]);
    }

    /**
     * Make a Delete Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function deleteRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('delete', $uri, [
            'headers' => $headers ?? $this->authenticatedHeaders(),
            'query' => $params
        ]);
    }

    /**
     * Get the Default Request Headers
     *
     * @return array
     */
    public function defaultHeaders(): array
    {
        return [
            'User-Agent' => InspiredDeck::AGENT . '/' . InspiredDeck::VERSION,
            'Accept'     => 'application/json',
        ];
    }

    /**
     * Get the Authenticated Request Headers
     *
     * @return array
     * @throws MissingTokenException
     */
    public function authenticatedHeaders(): array
    {
        return array_merge([
            'Authorization' => 'Bearer ' . InspiredDeck::getToken(),
        ], $this->defaultHeaders());
    }

    /**
     * Make a HTTP Request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return void|array
     * @throws mixed
     */
    private function makeHttpRequest(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->getHttpClient()->request($method, $uri, $options);

            return json_decode($response->getBody()->getContents(), true);

        } catch (ClientException $exception) {
            HttpRequestError::handle($exception);
        }
    }

}