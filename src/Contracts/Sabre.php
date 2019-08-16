<?php

namespace Ammonkc\Sabre\Contracts;

/**
 * Interface Sabre.
 *
 * @package namespace Ammonkc\Sabre\Contracts;
 */
interface Sabre
{
    /**
     * Get a client
     *
     * @param  string  The client to retrieve (null=default)
     * @return \Omnipay\Common\GatewayInterface
     */
    public function getClient();

    /**
     * @return HttpClient
     */
    public function getAccessToken($clientId, $clientSecret = null, $token = null, $method = self::OAUTH_CLIENT_CREDENTIALS);
}
