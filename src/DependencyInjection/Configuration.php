<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('weather_api_client');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        /** @var NodeDefinition $rootNode */
        $rootNode = $rootNode->children()
            ->scalarNode('api_key')->end();

        $rootNode->end();

        return $treeBuilder;
    }
}
