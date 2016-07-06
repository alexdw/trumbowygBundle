<?php

namespace Alexdw\TrumbowygBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\Kernel;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AlexdwTrumbowygExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('alexdw_trumbowyg.form.type.class', $config['class']);
        $container->setParameter('twig.form.resources', array_merge(
            $container->getParameter('twig.form.resources'),
            array('AlexdwTrumbowygBundle:Form:trumbowyg_widget.html.twig')
        ));

        $config['base_path'] = ltrim($config['base_path'], '/');

        $container->setParameter('alexdw_trumbowyg.trumbowyg.base_path', $config['base_path']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.svg_path', $config['svg_path']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.language', $config['language']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.btns', $config['btns']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.remove_format_pasted', $config['remove_format_pasted']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.autogrow', $config['autogrow']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.reset_css', $config['reset_css']);
        $container->setParameter('alexdw_trumbowyg.trumbowyg.semantic', $config['semantic']);

        if (Kernel::VERSION_ID < 30000) {
            // BC - Add alias if Symfony < 3.0
            $container->getDefinition('alexdw_trumbowyg.form.type')
                ->clearTag('form.type')
                ->addTag('form.type', array('alias' => 'trumbowyg'));
        }
    }

    private function getDefaultGroups()
    {
        return array();
    }
}