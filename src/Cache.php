<?php
namespace ExpressiveRedis;

use Predis\Client;

class Cache implements CacheContract
{
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
        return $this->client->setex($key, $ttlSeconds, $value);
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

}
