<?php

namespace Alexdw\TrumbowygBundle\Twig;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension as Twig_Extension;
use Twig\TwigFunction;

/**
 * Twig Extension for Trumbowyg support.
 *
 * @author Álex Martín <alex@alexdw.com>
 */
class TrumbowygExtension extends Twig_Extension
{
    /**
     * @var ContainerInterface $container Container interface
     */
    protected $container;

    /**
     * @var Environment $environment
     */
    protected $environment;

    /**
     * Initialize trumbowyg helper
     *
     * @param ContainerInterface $container
     * @param Environment $environment
     */
    public function __construct(ContainerInterface $container, Environment $environment)
    {
        $this->container = $container;
        $this->environment = $environment;
    }

    /**
     * Gets a service.
     *
     * @param string $id The service identifier
     *
     * @return object The associated service
     */
    public function getService($id)
    {
        return $this->container->get($id);
    }

    /**
     * Get parameters from the service container
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'trumbowyg_js' => new TwigFunction(
                'trumbowyg_js',
                array($this, 'trumbowygJs'),
                array('is_safe' => array('html'))
            ),
            'trumbowyg_css' => new TwigFunction(
                'trumbowyg_css',
                array($this, 'trumbowygCss'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * Trumbowyg JS init
     * @param array $options
     * @return string
     */
    public function trumbowygJs($options = array())
    {
        $config = $this->getParameter('alexdw_trumbowyg.config');
        $config = array_merge($config, $options);


        return $this->environment->render('@AlexdwTrumbowyg/Init/js.html.twig', array(
            'svg_path'      => $config['svg_path'],
            'base_path'     => $config['base_path'],
            'language'      => $config['language'],
            'include_jquery'=> $config['include_jquery'],
            'jquery_path'   => $config['jquery_path'],
        ));


    }

    /**
     * Trumbowyg JS init
     * @return string
     */
    public function trumbowygCss()
    {
        $config = $this->getParameter('alexdw_trumbowyg.config');
        return $this->environment->render('@AlexdwTrumbowyg/Init/css.html.twig', array(
            'base_path' => $config['base_path'],
        ));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'alexdw_trumbowyg';
    }

}
