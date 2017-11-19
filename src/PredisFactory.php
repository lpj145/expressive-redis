<?php
namespace ExpressiveRedis;

use Predis\Client;
use Psr\Container\ContainerInterface;

class PredisFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Client($container->get('config')['redis'] ?? []);
    }
}