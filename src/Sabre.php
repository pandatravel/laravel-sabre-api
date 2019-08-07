<?php

namespace Ammonkc\Sabre;

use Ammonkc\SabreApi\Client;
use Illuminate\Foundation\Application;

class Sabre
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The registered client
     *
     * @var \Ammonkc\SabreApi\Client $client
     */
    protected $client;

    /**
     * The default settings, applied to client
     */
    protected $defaults;

    /**
     * Constant for authentication method. Indicates the new favored login method
     * with username and password via HTTP Authentication.
     */
    const AUTH_HTTP_BASIC = 'http_basic';

    /**
     * Constant for authentication method. Indicates the new login method with
     * with username and token via HTTP Authentication.
     */
    const AUTH_HTTP_TOKEN = 'http_token';

    /**
     * Constant for authentication method. Indicates JSON Web Token
     * authentication required for integration access to the API.
     */
    const AUTH_JWT = 'jwt_token';

    /**
     * Constant for authentication method. Indicates JSON Web Token
     * authentication required for integration access to the API.
     */
    const OAUTH_CLIENT_CREDENTIALS = 'oauth_client';

    /**
     * Constant for authentication method. Indicates JSON Web Token
     * authentication required for integration access to the API.
     */
    const OAUTH_PASSWORD_CREDENTIALS = 'oauth_password';

    /**
     * Constant for authentication method. Indicates JSON Web Token
     * authentication required for integration access to the API.
     */
    const OAUTH_ACCESS_TOKEN = 'oauth_token';

    /**
     * Create a new Gateway manager instance.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @param  \Ammonkc\SabreApi\Client $client
     * @param  array
     */
    public function __construct(Application $app, Client $client, $defaults = [])
    {
        $this->app = $app;
        $this->client = $client;
        $this->defaults = $defaults;
        $this->config = $this->app['config'];
        $this->cache = $this->app['cache'];
        $this->tokenRepository = new TokenRepository($this->cache);

        $this->client->setParameter('pseudoCityCode', $this->config->get('sabre.pseudo_city_code'));
        $this->client->setDevMode($this->config->get('app.debug'));
    }

    /**
     * Get a client
     *
     * @param  string  The client to retrieve (null=default)
     * @return \Omnipay\Common\GatewayInterface
     */
    public function getClient()
    {
        $this->client->authenticate(
            $this->config->get('sabre.client_id'),
            $this->config->get('sabre.client_secret'),
            $this->tokenRepository->get(),
            self::OAUTH_CLIENT_CREDENTIALS,
            $this->tokenRepository
        );

        return $this->client;
    }

    /**
     * @return HttpClient
     */
    public function getAccessToken($clientId, $clientSecret = null, $token = null, $method = self::OAUTH_CLIENT_CREDENTIALS)
    {
        $token = $this->cache->rememberForever($this->tokenRepository::CACHE_KEY, function () use ($clientId, $clientSecret, $token, $method) {
            $token = $this->client->authenticateClientCredentials($clientId, $clientSecret, $token, $method);
            return encrypt($token);
        });

        return decrypt($token);
    }

    /**
     * Get the configuration, based on the config and the defaults.
     */
    protected function getConfig($name)
    {
        return array_merge(
            $this->defaults,
            $this->config->get('sabre.' . $name, [])
        );
    }

    /**
     * Dynamically call the client instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->getClient(), $method], $parameters);
    }
}
