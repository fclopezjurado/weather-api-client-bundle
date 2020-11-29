<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('weather_api_client');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('api_key')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
