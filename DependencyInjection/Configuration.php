<?php

namespace Brix\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('brix');


        $rootNode
            ->children()
                ->arrayNode('entities')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                      ->children()
                          ->scalarNode('class')->isRequired()->end()
                      ->end()
                  ->end()
                ->end()
                ->arrayNode('templates')
                // ->prototype('array')
                ->children()
                  ->arrayNode('widgets')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                      ->children()
                      ->scalarNode('title')->end()
                        ->scalarNode('template')->isRequired()->end()
                        ->scalarNode('entity')->end()
                    ->end()
                    ->end()
                  ->end()
                  ->arrayNode('pages')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                      ->children()
                        ->scalarNode('template')->isRequired()->end()
                        ->scalarNode('entity')->end()
                        ->arrayNode('blocks')->prototype('scalar')->end()
                    ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
