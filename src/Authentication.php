<?php

namespace MBLSolutions\InspiredDeck;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use MBLSolutions\InspiredDeck\Api\OAuthResource;
use MBLSolutions\InspiredDeck\Exceptions\AuthenticationException;
use MBLSolutions\InspiredDeck\Exceptions\ValidationException;

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

        } catch (ValidationException $exception) {
            throw new AuthenticationException($exception->getMessage(), $exception->getCode(), $exception->getPrevious(), $exception->getMessageBody());
        } catch (RequestException $exception) {
            $body = $exception->hasResponse() ? (string) $exception->getResponse()->getBody() : '';
            $decoded = json_decode($body, true);
            $response = is_array($decoded) ? $decoded : [];

            // A 429 passes the full body as the message
            $message = $exception->getCode() === 429 && $response !== [] ? $body : $exception->getMessage();

            throw new AuthenticationException($message, $exception->getCode(), $exception->getPrevious(), $response);
        } catch (Exception $exception) {
            throw new AuthenticationException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

}