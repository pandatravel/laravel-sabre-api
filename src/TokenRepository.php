<?php

namespace Ammonkc\Sabre;

use Illuminate\Cache\CacheManager as Cache;

class TokenRepository
{
    /**
     * Cache
     *
     * @var \Illuminate\Contracts\Cache\Repository $cache
     */
    protected $cache;

    /**
     * Constant for cache key
     */
    const CACHE_KEY = 'sabre_access_token';

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get the token
     *
     * @return \Laravel\Passport\Token
     */
    public function get()
    {
        if ($token = $this->cache->get(self::CACHE_KEY)) {
            $token = decrypt($token);
        }
        return $token;
    }

    /**
     * Store the given token instance.
     *
     * @param  $token
     * @return void
     */
    public function save($newToken)
    {
        $this->cache->forever(self::CACHE_KEY, encrypt($newToken));
    }

    /**
     * Clear the cache
     *
     * @return \Laravel\Passport\Token
     */
    public function clear()
    {
        return $this->cache->foreget(self::CACHE_KEY);
    }
}
