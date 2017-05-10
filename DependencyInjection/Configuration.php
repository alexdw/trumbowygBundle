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
                ->booleanNode('include_jquery')->defaultTrue()->end()
                ->scalarNode('base_path')->defaultValue('/bundles/alexdwtrumbowyg/')->end()
                ->scalarNode('svg_path')->defaultValue('/bundles/alexdwtrumbowyg/ui/icons.svg')->end()
                ->scalarNode('jquery_path')->defaultValue('/bundles/alexdwtrumbowyg/vendor/jquery-2.2.4.min.js')->end()
                ->scalarNode('language')->defaultValue('en')->end()
                ->booleanNode('remove_format_pasted')->defaultFalse()->end()
                ->booleanNode('autogrow')->defaultFalse()->end()
                ->booleanNode('reset_css')->defaultFalse()->end()
                ->booleanNode('semantic')->defaultFalse()->end()
                ->variableNode('btns_def')->defaultValue(array())->end()
                ->variableNode('btns')->defaultValue($this->defaultConfig())->end()
                ->variableNode('plugins')->defaultValue(array())->end()
            ->end();

        return $treeBuilder;
    }

    private function defaultConfig()
    {
        return array(
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
        );
    }
}
