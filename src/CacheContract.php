<?php
namespace ExpressiveRedis;

interface CacheContract
{
    public function set($key, $value, $ttlSeconds = 3600);

    public function get($key);

    public function has($key):bool;

    public function delete($key);
}
