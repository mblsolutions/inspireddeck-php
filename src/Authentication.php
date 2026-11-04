<?php

namespace MBLSolutions\InspiredDeck;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use MBLSolutions\InspiredDeck\Api\OAuthResource;
use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;

class Authentication extends OAuthResource
{
    /** Optional login fields sent with the password grant */
    private const EXTRA_FIELDS = ['otp', 'recovery_code'];

    /**
     * Authenticate with the Inspired Deck API using Password Grant
     *
     * @param int $client
     * @param string $secret
     * @param string $username
     * @param string $password
     * @param array $extra optional otp or recovery_code, other keys are ignored
     * @return array
     * @throws GuzzleException
     * @throws AuthenticationException
     */
    public function password(int $client, string $secret, string $username, string $password, array $extra = []): array
    {
        $extra = array_filter(array_intersect_key($extra, array_flip(self::EXTRA_FIELDS)), static function ($value) {
            return $value !== null;
        });

        try {
            $response = $this->getApiRequestor()->postRequest('/oauth/token', array_merge([
                'grant_type' => 'password',
                'client_id' => $client,
                'client_secret' => $secret,
                'username' => $username,
                'password' => $password,
                'scope' => '',
            ], $extra), $this->getApiRequestor()->defaultHeaders());

            InspiredDeck::setToken($response['access_token']);

            return $response;

        } catch (Exception $exception) {
            throw new AuthenticationException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

}