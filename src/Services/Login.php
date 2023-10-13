<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\LoginToken;
use professionalweb\api\Interfaces\Services\Registration;
use professionalweb\api\Interfaces\Services\Login as ILogin;
use professionalweb\api\Models\LoginToken as LoginTokenModel;

class Login implements ILogin, Registration
{
    public const METHOD_LOGIN = 'oauth/token';

    public const METHOD_REGISTRATION_BY_SIGN = 'api/v2/social/by-signed-data';

    public function __construct(
        private Client $client,
        private string $clientId,
        private string $clientSecret
    )
    {
    }

    /**
     * Login by e-mail
     *
     * @param string $email
     * @param string $password
     *
     * @return LoginToken
     * @throws GuzzleException
     */
    public function byEmail(string $email, string $password): LoginToken
    {
        $response = $this->client->post(self::METHOD_LOGIN, [
            'json' => [
                'grant_type'    => 'password',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'username'      => $email,
                'password'      => $password,
                'scope'         => '*',
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return new LoginTokenModel(
            $content['access_token'],
            $content['refresh_token'] ?? '',
            $content['token_type'] ?? 'Bearer',
            $content['expires_in'] ?? null
        );
    }

    /**
     * Register by signed data
     *
     * @param string $driver
     * @param array  $data
     * @param string $signature
     *
     * @return LoginToken
     * @throws GuzzleException
     */
    public function bySignedData(string $driver, array $data, string $signature): LoginToken
    {
        $data['sign'] = $signature;
        $response = $this->client->post(self::METHOD_REGISTRATION_BY_SIGN, [
            'json' => [
                'driver' => $driver,
                'data'   => $data,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return new LoginTokenModel(
            $content['access_token'],
            $content['refresh_token'] ?? '',
            $content['token_type'] ?? 'Bearer',
            $content['expires_in'] ?? null
        );
    }
}