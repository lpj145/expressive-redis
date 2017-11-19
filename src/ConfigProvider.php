<?php
namespace ExpressiveRedis;

use Predis\Client;

class ConfigProvider
{
    public function __invoke()
    {
        return [
          'dependencies' => $this->getDependencies()
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                Client::class => PredisFactory::class,
            ]
        ];
    }
}
