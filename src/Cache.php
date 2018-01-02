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

    /**
     * Cache constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $key
     * @param $value
     * @param int $ttlSeconds
     * @return int|mixed
     */
    public function set($key, $value, $ttlSeconds = 3600)
    {
        if ($ttlSeconds !== -1) {
            return $this->client->setex($key, $ttlSeconds, $value);
        }
        return $this->client->set($key, $value);
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key)
    {
        return $this->client->get($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return (bool)$this->client->exists($key);
    }

    /**
     * @param $key
     * @return int
     */
    public function delete($key)
    {
        return $this->client->del($key);
    }

    /**
     * @param $key
     * @param $time
     * @return int
     */
    public function reloadTtl($key, $time)
    {
        return $this->client->expire($key, $time);
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
