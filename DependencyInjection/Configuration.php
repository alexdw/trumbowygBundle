<?php

namespace Alexdw\TrumbowygBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('alexdw_trumbowyg');

        $rootNode
            ->children()
                ->scalarNode('class')->defaultValue('Alexdw\TrumbowygBundle\Form\Type\TrumbowygType')->end()
            ->end()
            ->children()
                ->scalarNode('base_path')
                    ->defaultValue('/bundles/alexdwtrumbowyg/')
                    ->info('The base URL path used to load trumbowyg files from.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('svg_path')
                    ->defaultValue('/bundles/alexdwtrumbowyg/ui/icons.svg')
                    ->info('The base URL path used to load trumbowyg icons from.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('language')
                    ->defaultValue('en')
                    ->info('The language used by trumbowyg.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('remove_format_pasted')
                    ->defaultValue("false")
                    ->info('Remove format pasted.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('autogrow')
                    ->defaultValue("false")
                    ->info('The text editon zone can extend itself.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('reset_css')
                    ->defaultValue("false")
                    ->info('Reset the css in the editor.')
                ->end()
            ->end()
            ->children()
                ->scalarNode('semantic')
                    ->defaultValue("false")
                    ->info('Generates a better, more semantic oriented HTML.')
                ->end()
            ->end()
            ->children()
                ->variableNode('btns')
                ->defaultValue(array(
                    array("viewHTML"),
                    array("formatting"),
                    "btnGrp-semantic",
                    array("superscript","subscript"),
                    array("link"),
                    array("insertImage"),
                    "btnGrp-justify",
                    "btnGrp-lists",
                    array("horizontalRule"),
                    array("removeformat"),
                    array("fullscreen")
                ))
                ->info('The default toolbar displayed on the editor.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
