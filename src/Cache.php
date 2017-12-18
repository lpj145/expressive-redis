<?php
namespace ExpressiveRedis;

use Predis\Client;

class Cache implements CacheContract
{
    /**
     * @var Cache
     */
    private static $globalInstance;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function set($key, $value, $ttlSeconds = 3600)
    {
        if ($ttlSeconds !== -1) {
            return $this->client->setex($key, $ttlSeconds, $value);
        }
        return $this->client->set($key, $value);
    }

    public function get($key)
    {
        return $this->client->get($key);
    }

    public function has($key): bool
    {
        return (bool)$this->client->exists($key);
    }

    public function delete($key)
    {
        return $this->client->del($key);
    }

    /**
     * Set instance of redis cache global scope
     */
    public function setAsGlobal()
    {
        self::$globalInstance = $this;
    }


    /**
     * @return Cache
     */
    public static function instance()
    {
        return self::$globalInstance;
    }

}
