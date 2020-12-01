<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\HttpClient;

class WeatherApiClientExtension extends Extension
{
    /**
     * @param array[]          $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yaml');

        $configuration = new Configuration();
        $configurationData = $this->processConfiguration($configuration, $configs);
        $httpClientServiceDefinition = $container->getDefinition(HttpClient::class);

        $httpClientServiceDefinition->addArgument($configurationData['api_key']);
    }
}
