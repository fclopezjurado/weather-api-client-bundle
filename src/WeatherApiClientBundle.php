<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tui\Weather\ApiClient\DependencyInjection\WeatherApiClientExtension;

class WeatherApiClientBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new WeatherApiClientExtension();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
