<?php
namespace ExpressiveRedis;

use Predis\Client;
use Psr\Container\ContainerInterface;

class PredisFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $redisConfig = $container->get('config')['redis'];
        return new Client(
            $redisConfig['redis']['connection'] ?? [],
            $redisConfig['redis']['options'] ?? []
        );
    }
}