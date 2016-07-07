<?php

namespace Alexdw\TrumbowygBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Twig Extension for Trumbowyg support.
 *
 * @author Álex Martín <alex@alexdw.com>
 */
class TrumbowygExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface $container Container interface
     */
    protected $container;

    /**
     * Asset Base Url
     *
     * Used to over ride the asset base url (to not use CDN for instance)
     *
     * @var String
     */
    protected $baseUrl;

    /**
     * Initialize tinymce helper
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
            'trumbowyg_js' => new \Twig_SimpleFunction(
                'trumbowyg_js',
                array($this, 'trumbowygJs'),
                array('is_safe' => array('html'))
            ),
            'trumbowyg_css' => new \Twig_SimpleFunction(
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
        $config = array_merge_recursive($config, $options);

        $formCollector = $this->getService("data_collector.form");
        $forms = $formCollector->getData()["forms"];

        $trumbowygFields = array();

        foreach ($forms as $form){
            foreach ($form["children"] as $item){
                if($item["type"]=="trumbowyg"){
                    $trumbowygFields[$item["id"]] = array_merge($config, $item["passed_options"]);
                }
            }
        }

        return $this->getService('templating')->render('AlexdwTrumbowygBundle:Init:js.html.twig', array(
            'svg_path'     => $config['svg_path'],
            'base_path'     => $config['base_path'],
            'language'     => $config['language'],
            'fields'     => $trumbowygFields,
            'include_jquery'     => $config['include_jquery'],
        ));


    }
    /**
     * Trumbowyg JS init
     * @param array $options
     * @return string
     */
    public function trumbowygCss()
    {
        $config = $this->getParameter('alexdw_trumbowyg.config');
        return $this->getService('templating')->render('AlexdwTrumbowygBundle:Init:css.html.twig', array(
            'base_path'     => $config['base_path'],
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