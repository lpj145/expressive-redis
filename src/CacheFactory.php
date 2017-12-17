<?php
namespace ExpressiveRedis;

use Predis\Client;
use Psr\Container\ContainerInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $cache = new Cache($container->get(Client::class));
        $cache->setAsGlobal();
        return $cache;
    }
}
